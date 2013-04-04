<?php
/**
 * TruncateSmsCommand class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * TruncateSmsCommand is ...
 */
Yii::import('isms.IsmsModule');
Yii::import('isms.models.*');
Yii::import('ext.helpers.*');
class TruncateSmsCommand extends CConsoleCommand
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
    	$this->log('info', 'Connected to %string', array('%string' => $connection->connectionString));
    	$tables = $connection->getSchema()->getTableNames();
    	foreach ($tables as $table){
    		$this->log('info', 'Scan table %table', array('%table' => $table));
    		if (strpos($table, 'send_sms_') !== FALSE){
    			$keeps = $connection->createCommand()->from($table)->where('sql_id < 1000')->queryAll();
    			$this->log('info', 'Truncate table %table and re-insert %count', array('%table' => $table, '%count' => count($keeps)));
    			$connection->createCommand()->truncateTable($table)
    			//->execute()
    			;
    			foreach ($keeps as $sms){
    				$connection->createCommand()->insert($table, $sms);
    			}
    		}
    		if (strpos($table, 'sent_sms_') !== FALSE){
    			$keeps = $connection->createCommand()->from($table)->where('sql_id < 1000')->queryAll();
    			$this->log('info', 'Truncate table %table and re-insert %count', array('%table' => $table, '%count' => count($keeps)));
    			$connection->createCommand()->truncateTable($table)
    			//->execute()
    			;
    			foreach ($keeps as $sms){
    				$connection->createCommand()->insert($table, $sms);
    			}
    		}
    	}
        // $args gives an array of the command-line arguments for this command
    }
	/**
	 * Provides the command description.
	 * This method may be overridden to return the actual command description.
	 * @return string the command description. Defaults to 'Usage: php entry-script.php command-name'.
	 */
    public function getHelp()
    {
        return 'This command will truncate and re-populate all campaign send_sms and sent_sms tables.';
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