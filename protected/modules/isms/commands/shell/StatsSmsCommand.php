<?php
/**
 * StatsSmsCommand class file.
 *
 *momt,	sender,	receiver, udhdata,msgdata,time,smsc_id,service,account,id,sms_type,mclass,mwi,coding,compress,validity,deferred,dlr_mask,dlr_url,pid,alt_dcs,rpi,charset,boxc_id,binfo,campaign_id,bearerbox_id

insert into sent_sms select momt,sender,receiver, udhdata,msgdata,time,smsc_id,service,account,id,sms_type,mclass,mwi,coding,compress,validity,deferred,dlr_mask,dlr_url,pid,alt_dcs,rpi,charset,boxc_id,binfo,campaign_id,bearerbox_id FROM sent_sms_134;
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * StatsSmsCommand is ...
 */
Yii::import('isms.IsmsModule');
Yii::import('isms.models.*');
Yii::import('ext.helpers.*');
class StatsSmsCommand extends CConsoleCommand
{
	function log($category, $message, $params = array()){
		echo @date('Y/m/d H:i:s',time()). "[$category] ".strtr($message, $params) . "\n";
	}
	/**
	 * Executes the command.
	 * @param array command line parameters for this command.
	 */
    public function run($args)
    {
    	$connection = Campaign::model()->getDbConnection();
    	$campaigns = Campaign::model()->findAll();
    	foreach ($campaigns as $campaign){
    		$table = 'send_sms_' . $campaign->getPrimaryKey();
    		// Calculate send SMS
    		$campaign->send = $connection->createCommand("SELECT COUNT(*) FROM send_sms WHERE campaign_id=".$campaign->getPrimaryKey())->queryScalar();
    		if (!is_null($connection->getSchema()->getTable($table) )) {
    			$campaign->send += $connection->createCommand("SELECT COUNT(*) FROM $table")->queryScalar();
    			$connection->createCommand("UPDATE $table SET campaign_id=" . $campaign->getPrimaryKey())->execute();
    			// Migrate to send_sms table and truncate old table
    			$connection->createCommand("INSERT INTO send_sms SELECT momt,sender,receiver, udhdata,msgdata,time,smsc_id,service,account,id,sms_type,mclass,mwi,coding,compress,validity,deferred,dlr_mask,dlr_url,pid,alt_dcs,rpi,charset,boxc_id,binfo,campaign_id,bearerbox_id FROM $table ON DUPLICATE KEY UPDATE campaign_id=".$campaign->getPrimaryKey())->execute();
    			$connection->createCommand()->dropTable($table);
    			$this->log('info', 'Campaign #%cid %title has %count SMS to send', array('%cid' => $campaign->getPrimaryKey(), '%title' => $campaign->title, '%count' => $campaign->send ));
    		}
    		$table = 'sent_sms_' . $campaign->getPrimaryKey();
    		// Calculate sent SMS
    		$campaign->sent = $connection->createCommand("SELECT COUNT(*) FROM sent_sms WHERE campaign_id=".$campaign->getPrimaryKey())->queryScalar();
    		if (!is_null($connection->getSchema()->getTable($table))) {
    			$campaign->sent += $connection->createCommand("SELECT COUNT(*) FROM $table")->queryScalar();
    			$connection->createCommand("UPDATE $table SET campaign_id=" . $campaign->getPrimaryKey())->execute();
    			// Migrate to send_sms table and truncate old table
    			$connection->createCommand("INSERT INTO sent_sms SELECT momt,sender,receiver, udhdata,msgdata,time,smsc_id,service,account,id,sms_type,mclass,mwi,coding,compress,validity,deferred,dlr_mask,dlr_url,pid,alt_dcs,rpi,charset,boxc_id,binfo,campaign_id,bearerbox_id FROM $table ON DUPLICATE KEY UPDATE campaign_id=".$campaign->getPrimaryKey())->execute();
    			$connection->createCommand()->dropTable($table);
    			$this->log('info', 'Campaign #%cid %title has sent %count SMS.', array('%cid' => $campaign->getPrimaryKey(), '%title' => $campaign->title, '%count' => $campaign->sent ));
    		}
    		$campaign->save();
    	}
    }
	/**
	 * Provides the command description.
	 * This method may be overridden to return the actual command description.
	 * @return string the command description. Defaults to 'Usage: php entry-script.php command-name'.
	 */
    public function getHelp()
    {
        return 'This command will count all rows in send_sms and sent_sms and fill in the campaign table.';
    }

    /**
     * Dumps a variable or the object itself in terms of a string.
     *
     * @param mixed variable to be dumped
     */
    protected function dump($var='dump-the-object',$highlight=true)
    {
        if ($var === 'dump-the-object') {
            return CVarDumper::dumpAsString($this,$depth=15,$highlight);
        } else {
            return CVarDumper::dumpAsString($var,$depth=15,$highlight);
        }
    }
}