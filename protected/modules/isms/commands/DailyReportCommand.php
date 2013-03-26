<?php
/**
 * DailyReportCommand class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * DailyReportCommand is ...
 */
Yii::import('isms.IsmsModule');
Yii::import('isms.models.*');
Yii::import('ext.helpers.*');
class DailyReportCommand extends CConsoleCommand
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
        // $args gives an array of the command-line arguments for this command
        $lastReport = Dailyreport::model()->find('ORDER BY created_date DESC');
        if (! empty($lastReport)) $lastReport = $lastReport->createtime;
        else $lastReport = 0;

        $sentdata = Yii::app()->db->createCommand(
        	"SELECT COUNT(*) AS count, campaign_id FROM sent_sms WHERE time > $lastReport GROUP BY campaign_id"
        ) ->queryAll();
        $dlrdata = Yii::app()->db->createCommand(
        	"SELECT COUNT(*) AS count, campaign_id FROM sent_sms WHERE time > $lastReport AND dlr_mask=31 GROUP BY campaign_id"
        ) ->queryAll();

        $dailyReport = array();
        foreach ($sentdata as $row){
        	$dailyReport[$row->campaign_id] = new Dailyreport();
        	$dailyReport[$row->campaign_id]->sent_sms = $row->count;
        	$dailyReport[$row->campaign_id]->campaign_id = $row->campaign_id;
        }
        foreach ($dlrdata as $row){
        	$dailyReport[$row->campaign_id] = new Dailyreport();
        	$dailyReport[$row->campaign_id]->sms_delivered = $row->count;
        }

        foreach ($dailyReport as $pk => $row){
        	$cp = Campaign::model()->findByPk($pk);
        	if (strpos($cp->tempate, '{') === FALSE){
        		$block = ceil(strlen($cp->template) / 160);
        		$dailyReport->block_sent = $block * $dailyReport->sms_sent;
        		$dailyReport->block_delivered = $block * $dailyReport->sms_delivered;
        	} else {
        		// We need to calculate it correctly, right?
        		$dailyReport->block_sent = Yii::app()->db->createCommand(
        				"SELECT SUM(CEIL(LENGTH(msgdata)/160)) AS count FROM sent_sms WHERE time > $lastReport AND campaign_id = ".$cp->id
        		) ->queryScalar();
        		$dailyReport->block_delivered = Yii::app()->db->createCommand(
        				"SELECT SUM(CEIL(LENGTH(msgdata)/160)) AS count FROM sent_sms WHERE time > $lastReport AND dlr_mask=31 AND campaign_id = ".$cp->id
        		) ->queryScalar();
        	}
        	$dailyReport->created_date = date('Y-m-d');
        	$dailyReport->save();
        }
    }
	/**
	 * Provides the command description.
	 * This method may be overridden to return the actual command description.
	 * @return string the command description. Defaults to 'Usage: php entry-script.php command-name'.
	 */
    public function getHelp()
    {
        return 'This script run about 5-10 mins to collect summarized campaign data.';
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