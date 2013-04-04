<?php
/**
 * CampaignSwitchCommand class file.
 */
Yii::import('isms.models.*');
Yii::import('isms.IsmsModule');
class CampaignSwitchCommand extends CConsoleCommand
{
	/**
	 * Executes the command.
	 * @param array command line parameters for this command.
	 */
    public function run($args)
    {
        $this->activateStartCampaigns();
    }

    function log($category, $message, $params = array()){
    	Yii::log($message, 'debug', get_class($this));
    	echo @date('Y/m/d H:i:s',time()). "[$category] ".strtr($message, $params) . "\n";
    }



    function activateStartCampaigns() {
	$cmd = Yii::app()->db->createCommand("UPDATE campaign SET finished=1 WHERE end < NOW() AND approved=1")->execute();
    	$weekday = date('w') + 1;
    	$time = date('H:i:s');
    	$this->log('info', 'Weekday: %wk, Time: %t', array('%wk' => $weekday, '%t' => $time));
		$campaigns = Campaign::model()
		->findAllByAttributes(array(
				'ready' => Campaign::READY_ALL,
				'status' => Campaign::STATUS_ENABLE,
				'finished'	=>	Campaign::FINISHED_FALSE,
			)
		);
		foreach ($campaigns as $cp){
			$this->log('info',  'Found running campaign :title with id :id', array(':title' => $cp->title, ':id' => $cp->id));
			$cp->setScenario('campaignswitch');
			$cp->saveAttributes(
    		array(
    			'ready' => Campaign::READY_ALL,
    			'status' => Campaign::STATUS_ENABLE,
					'finished'	=>	Campaign::FINISHED_FALSE,
    		)
    	);
		}
		$query = Yii::app()->db->createCommand(
'UPDATE `campaign` `t`
	LEFT JOIN `cpworktime` `cp` ON t.id=cp.cid
	LEFT JOIN `worktime` `w` ON w.id=cp.tid
	 SET t.active=:active WHERE (t.ready=:ready) AND (t.status=:status) AND (t.finished=:finished) AND (t.start <= NOW()) AND (t.end >= NOW()) AND (t.cpworkday LIKE "%' . $weekday. '%") AND (w.start <= :time) AND (w.end >= :time)'
)->execute(array(
				':ready' => Campaign::READY_ALL,
				':status' => Campaign::STATUS_ENABLE,
				':finished' => Campaign::FINISHED_FALSE,
				':time' => $time,
				':active'	=>	Campaign::ACTIVE_RUNNING,
));
		$this->log('info', "Change status to ACTIVE_RUNNING for $query campaigns");
    }

    function dropOldCampaigns() {
    	$campaigns = Campaign::model()
    	->findAll('end <= DATE_SUB(NOW(), INTERVAL 3 MONTH)');
    	// @TODO : Extract sent_sms_[cid] into file and archived...
    	foreach ($campaigns as $c){
    		Sentsms::$cid = $c->id;
    		//Sentsms::model()->dropTable();
    		echo "Done archived sent SMS for campaign " . $c->title . '\n';
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
