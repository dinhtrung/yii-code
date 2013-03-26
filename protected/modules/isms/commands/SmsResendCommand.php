<?php
/**
 * SmsImportCommand class file.
INSERT INTO send_sms (momt, sender, receiver, msgdata, sms_type, coding, charset, campaign_id, dlr_mask, smsc_id) SELECT momt, sender, receiver, msgdata, sms_type, coding, charset, campaign_id, dlr_mask, smsc_id FROM sent_sms WHERE dlr=0 AND campaign_id=1600 ;
DELETE FROM sent_sms WHERE dlr=0 AND campaign_id=1600 ;
UPDATE campaign SET finished=0 WHERE id=1600; *
 */
Yii::import('isms.IsmsModule');
Yii::import('isms.models.*');
Yii::import('ext.helpers.*');
class SmsResendCommand extends CConsoleCommand
{
	public $csvMimeTypes = array('text/comma-separated-values', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'text/anytext');
        public $textMimeTypes = array('text/plain',
'application/txt', 'browser/internal', 'text/anytext', 'widetext/plain', 'widetext/paragraph'
);
	public $zipMimeTypes = array('application/zip',
'application/x-zip',
'application/x-zip-compressed', 'application/octet-stream', 'application/x-compress', 'application/x-compressed', 'multipart/x-zip');
	function log($category, $message, $params = array()){
		echo @date('Y/m/d H:i:s',time()). "[$category] ".strtr($message, $params) . "\n";
	}
	/**
	 * Executes the command.
	 * @param array command line parameters for this command.
	 */
    public function run($args)
    {
        // $args gives an array of the command-line arguments for this command
       	$campaigns  = Campaign::model()->findAll('finished=1 AND approved=1 AND end > NOW()');
       	$now = date('Y-m-d H:i:s', time() - 30*60);
        foreach ($campaigns as $c){
        	$cid = $c->id;

        	// Kiem tra thoi gian gui tin...
        	$time = Yii::app()->db->createCommand("SELECT time FROM sent_sms WHERE campaign_id=$cid ORDER BY time desc LIMIT 1")->queryScalar();

        	$flag = intval($time > $now);

        	$this->log('info', "Campaign $cid has latest sent is $time . 30 minute ago is $now . Compare: time > now is $flag");
					if ($flag){
	        	$this->log("info", "Trying to resend failed SMS for campaign #".$c->id." ".$c->title);
		      	$cmd = Yii::app()->db->createCommand("INSERT INTO send_sms (momt, sender, receiver, msgdata, sms_type, coding, charset, campaign_id, dlr_mask, smsc_id) SELECT momt, sender, receiver, msgdata, sms_type, coding, charset, campaign_id, dlr_mask, smsc_id FROM sent_sms WHERE dlr=0 AND campaign_id=$cid")->execute();
		      	$cmd = Yii::app()->db->createCommand("DELETE FROM sent_sms WHERE dlr=0 AND campaign_id=$cid")->execute();
		      	$cmd = Yii::app()->db->createCommand("UPDATE campaign SET finished=0, blocksent=NULL, sent=NULL WHERE id=$cid")->execute();
        	}
        }
    }


	/**
	 * Provides the command description.
	 * This method may be overridden to return the actual command description.
	 * @return string the command description. Defaults to 'Usage: php entry-script.php command-name'.
	 */
    public function getHelp()
    {
        return '
		This command line will be executed 1 hour before campaign start.

		It will retrieve files from FTP, then import data files for the campaign

		Usage: smsimport [campaign.id]';
    }

}
