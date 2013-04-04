<?php
/**
 * CampaignSwitchCommand class file.
 */
Yii::import('isms.models.*');
Yii::import('isms.IsmsModule');
class CampaignExportCommand extends CConsoleCommand
{
	/**
	 * Executes the command.
	 * @param array command line parameters for this command.
	 */
    public function run($args)
    {
        $this->statCampaigns();
    }

    function log($category, $message, $params = array()){
    	Yii::log($message, 'debug', get_class($this));
    	echo @date('Y/m/d H:i:s',time()). "[$category] ".strtr($message, $params) . "\n";
    }

    function statCampaigns(){
    	$campaigns= Campaign::model()->findAll("finished=1 AND end < NOW() AND (exported!=1 OR exported IS NULL)");
    	foreach ($campaigns as $cp){
    		$this->log('info', "Processing campaign #" . $cp->id. " - ".$cp->title );
    		Yii::app()->db->createCommand("UPDATE campaign SET exported = 1 WHERE id = " . $cp->id)->execute();
		  	$query ="SELECT time, sender, receiver, URLDECODE(msgdata) AS msg INTO OUTFILE ':outfile' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' FROM sent_sms WHERE campaign_id=" . $cp->id . " AND dlr=1";

				$outfile = '/tmp/sent_sms_' . $cp->id . '.csv';
				@unlink($outfile);
		  	$cmd = Yii::app()->db->createCommand(
		  			strtr($query, array(
		  					':outfile' => $outfile,
		  			)));
		  	$this->log('debug', $cmd->getText());
		  	if ($cmd->execute()){
			  	echo Yii::t('app', "Done export file !file \n", array('!file' => $outfile));
			  	exec("tar -czvf /var/www/isms/results/campaign_".$cp->id.".tar.gz ".$outfile);
			  	exec("chown apache:apache /var/www/isms/results/campaign_".$cp->id.".tar.gz");
			  	@unlink($outfile);
		  	}
$query ="SELECT time, sender, receiver, URLDECODE(msgdata) AS msg INTO OUTFILE ':outfile' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' FROM sent_sms WHERE campaign_id=" . $cp->id . " AND dlr=0";

                                $outfile = '/tmp/sent_dlr0_' . $cp->id . '.csv';
                                @unlink($outfile);
                        $cmd = Yii::app()->db->createCommand(
                                        strtr($query, array(
                                                        ':outfile' => $outfile,
                                        )));
                        $this->log('debug', $cmd->getText());
                        if ($cmd->execute()){
                                echo Yii::t('app', "Done export file !file \n", array('!file' => $outfile));
                                exec("tar -czvf /var/www/isms/results/error_".$cp->id.".tar.gz ".$outfile);
                                exec("chown apache:apache /var/www/isms/results/error_".$cp->id.".tar.gz");
                                @unlink($outfile);
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
        return 'This command check all Campaign and activate or de-activate them by expiration date, delete old data, or retrieve email and send new campaign.';
    }

}
