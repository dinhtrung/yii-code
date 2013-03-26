<?php
/**
 * CampaignSwitchCommand class file.
 */
Yii::import('isms.models.*');
Yii::import('isms.IsmsModule');
class InboxMessage {
	public $subject = '';
	public $msg = '';
	public $attachments = array();

	public function __construct($mbox, $mid){
		$h = imap_header($mbox,$mid);
		$this->subject = strtolower(trim($h->subject));
		$s = imap_fetchstructure($mbox,$mid);
		if (empty($s->parts)){  // not multipart
			$this->getpart($mbox,$mid,$s,0);  // no part-number, so pass 0
		} elseif (is_array($s->parts)) {  // multipart: iterate through each part
			foreach ($s->parts as $partno0=>$p) {
				$this->getpart($mbox,$mid,$p,$partno0+1);
			}
		}
	}


	function getpart($mbox,$mid,$p,$partno) {
		// DECODE DATA
		$data = ($partno)?
			imap_fetchbody($mbox,$mid,$partno):  // multipart
			imap_body($mbox,$mid);  // not multipart
		if ($p->type != 0) return;
		// Any part may be encoded, even plain text messages, so check everything.
		if ($p->encoding==4)
			$data = quoted_printable_decode($data);
		elseif ($p->encoding==3)
			$data = base64_decode($data);
		// 	no need to decode 7-bit, 8-bit, or binary

		// PARAMETERS
		// get all parameters, like charset, filenames of attachments, etc.
		$params = array();
		if (! empty($p->parameters))
			foreach ($p->parameters as $x)
				$params[ strtolower( $x->attribute ) ] = $x->value;
		if (! empty($p->dparameters))
			foreach ($p->dparameters as $x)
				$params[ strtolower( $x->attribute ) ] = $x->value;

		// ATTACHMENT
		// Any part with a filename is an attachment,
		// so an attached text file (type 0) is not mistaken as the message.
		if (! empty($params['filename']) || ! empty($params['name'])) {
			// filename may be given as 'Filename' or 'Name' or both
			$filename = ($params['filename'])? $params['filename'] : $params['name'];
		    		// filename may be encoded, so see imap_mime_header_decode()
		    		$this->attachments[strtolower($filename)] = $data;  // this is a problem if two files have same name
		}

		// TEXT
		elseif ($p->type==0 && $data) {
		    	// Messages may be split in different parts because of inline attachments,
			// so append parts together with blank row.
			if (strtolower($p->subtype)=='plain')
			$this->msg .= trim($data) ."\n\n";
		}

		// EMBEDDED MESSAGE
		// Many bounce notifications embed the original message as type 2,
		// but AOL uses type 1 (multipart), which is not handled here.
		// There are no PHP functions to parse embedded messages,
	    // so this just appends the raw source to the main message.
		elseif ($p->type==2 && $data) {
			$this->msg .= trim($data) ."\n\n";
		}

		// 	SUBPART RECURSION
		if (! empty($p->parts)) {
			foreach ($p->parts as $partno0=>$p2)
			getpart($mbox,$mid,$p2,$partno.'.'.($partno0+1));  // 1.2, 1.2.1, etc.
		}
	}

}
class CampaignEmailCommand extends CConsoleCommand
{
	/**
	 * Executes the command.
	 * @param array command line parameters for this command.
	 */
    public function run($args)
    {
        // $args gives an array of the command-line arguments for this command
        if (! empty($args) && ($args[0] == 'test')){
        	$campaign = Campaign::model()->find();
        	$template = "Here we are... Testing a new campaign, created by Email Script...";
        	$this->process_campaign($campaign, $template);
        }
        $this->checkEmail();
        if (YII_DEBUG) CVarDumper::dump(Yii::getLogger()->getProfilingResults());
    }
    function log($category, $message, $params = array()){
    	echo @date('Y/m/d H:i:s',time()). "[$category] ".strtr($message, $params) . "\n";
    }
    function checkEmail() {
    	$mailbox = Emailsetting::model()->findAll();
    	foreach ($mailbox as $mbox){
    		// @FIXME: Cannot create imap_open from this... Dont know why
    		//$connection = $mbox->openMailbox();
    		$connection = imap_open('{10.151.6.250:143/notls}INBOX', 'isms', 'isms@12345678');
    		if ($connection === FALSE) {
    			$this->log('error', 'Cannot connect to mailbox :mbox with :mailbox, :user, :pass', array(':mbox' => $mbox, ':mailbox' => $mbox->getMailbox(), ':user' => $mbox->getUsername(), ':pass' => $mbox->password));
    		} else {
    			$this->log('info', 'Connectted to mailbox :mbox with :mailbox, :user, :pass', array(':mbox' => $mbox, ':mailbox' => $mbox->getMailbox(), ':user' => $mbox->getUsername(), ':pass' => $mbox->password));
	    		//$newmails = @imap_search($connection, 'UNSEEN');
	    		$newmails = @imap_search($connection, 'UNSEEN');
	    		if (! empty($newmails)){
		    		$cpsubjects = array();
		    		$cpattachments = array();
		    		$keys = array();
		    		$campaigns = Campaign::model()->findAllByAttributes(array('emailbox' => $mbox->id));

		    		foreach ($campaigns as $key => $cp){
		    			$keys[$cp->id] = $key;
		    			$cpsubjects[$cp->id] = strtolower($cp->esubject);
		    			$cpattachments[$cp->id] = strtolower($cp->eattachment);
		    		}
		    		$this->log('debug', "Search subjects: :sub", array(':sub' => var_export($cpsubjects, TRUE)));
		    		$this->log('debug', "Attachments: :sub", array(':sub' => var_export($cpattachments, TRUE)));
		    		$emails = array();
		    		foreach ($newmails as $email_number){
		    			$emails[$email_number] = $mail = new InboxMessage($connection, $email_number);
		    			$this->log('info', "Retrieve a message with subject: %sbj", array('%sbj' => $mail->subject));
		    			if ($cpid = array_search($mail->subject, $cpsubjects)){
			    			$this->log('info', "Found campaign [%id] match Email Subject: %sbj", array('%sbj' => $mail->subject, '%id' => $cpid));
			    			if (array_key_exists($cpattachments[$cpid], $mail->attachments)){
			    				$this->process_campaign($campaigns[$keys[$cpid]], $mail->attachments[$cpattachments[$cpid]]);
			    			} else {
			    				$this->log('info', "No attachment named [%at] in the email. Available attachments: %atts", array('%at' => $cpattachments[$cpid], '%atts' => var_export($mail->attachments, TRUE)));
			    			}
		    			}
		    		}
	    		}
	    		imap_close($connection);
    		}
    	}
    }

    /**
     * Process campaign for sending email template...
     * @param unknown_type $cpid
     * @param unknown_type $template
     */
    private function process_campaign($campaign, $template){
    	$this->log('info', 'Process campaign id %id with template [%template]', array('%id' => $campaign->id, '%template' => $template));
    	// Clone a new campaign based on current campaign, right?
    	$new = new Campaign();
    	$new->setAttributes(array_merge($campaign->getAttributes(), array(
    		'description'	=>	Yii::t('app', 'This is the child campaign of campaign :id :title', array(':id' => $campaign->id, ':title' => $campaign->title)),
			'template'	=>	$template,
			'ready'		=>	Campaign::READY_NOTYET,
			'active'	=>	Campaign::ACTIVE_PENDING,
			'status'	=>	Campaign::STATUS_ENABLE,
    		'finished'	=>  Campaign::FINISHED_FALSE,
    		'emailbox'	=>	NULL,
    		'eattachment'	=>	NULL,
    		'esubject'	=>	NULL,
    	)));
    	$new->save();
    	// Clone relations...
    	$entities = Cpfilter::model()->findAllByAttributes(array('cid' => $campaign->id));
    	foreach ($entities as $entity){
    		$entity->setScenario('insert');
    		$entity->cid = $new->id;
    		$entity->save();
    	}
    	$entities = Ftpfilename::model()->findAllByAttributes(array('cid' => $campaign->id));
    	foreach ($entities as $entity){
    		$entity->setScenario('insert');
    		$entity->cid = $new->id;
    		$entity->save();
    	}
    	$entities = Cpworktime::model()->findAllByAttributes(array('cid' => $campaign->id));
    	foreach ($entities as $entity){
    		$entity->setScenario('insert');
    		$entity->cid = $new->id;
    		$entity->save();
    	}
    	$entities = Cpfile::model()->findAllByAttributes(array('cid' => $campaign->id));
    	foreach ($entities as $entity){
    		$entity->setScenario('insert');
    		$entity->cid = $new->id;
    		$entity->status = Cpfile::STATUS_NEW;
    		$entity->save();
    	}
    	$this->log('info', 'Successfully clone campaign ' . $campaign->id . ' to ' . $new->id);
    }
	/**
	 * Provides the command description.
	 * This method may be overridden to return the actual command description.
	 * @return string the command description. Defaults to 'Usage: php entry-script.php command-name'.
	 */
    public function getHelp()
    {
        return 'This command check current Campaign and activate or de-activate them by expiration date, delete old data, or retrieve email and send new campaign.';
    }
}
