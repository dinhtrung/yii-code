<?php
/**
 * FilterImportCommand class file.
 *
 * SQL To load data from a text file
 *

SELECT * INTO OUTFILE '/home/root/:outfile.csv'
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
ESCAPED BY '\\'
LINES TERMINATED BY '\n'
FROM :table
WHERE fid=':fid'
 *
 */
Yii::import('isms.IsmsModule');
Yii::import('isms.models.*');
Yii::import('ext.helpers.*');
class FilterExportCommand extends CConsoleCommand
{
	public $csvMimeTypes = array('text/comma-separated-values', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'text/anytext');
        public $textMimeTypes = array('text/plain',
'application/txt', 'browser/internal', 'text/anytext', 'widetext/plain', 'widetext/paragraph'
);
	public $zipMimeTypes = array('application/zip','application/x-zip','application/x-zip-compressed', 'application/octet-stream', 'application/x-compress', 'application/x-compressed', 'multipart/x-zip');
	function log($category, $message, $params = array()){
		echo @date('Y/m/d H:i:s',time()). "[$category] ".strtr($message, $params) . "\n";
	}
	/**
	 * Executes the command.
	 * @param array command line parameters for this command.
	 */
    public function run($args)
    {
	// ISTT:: Delete send sms and sent_sms older than 90 days...
	$query = "DELETE FROM send_sms WHERE time < DATE_SUB(NOW(), INTERVAL 90 DAY)";
	$cmd = Yii::app()->db->createCommand($query)->execute();
	$query = "DELETE FROM sent_sms WHERE time < DATE_SUB(NOW(), INTERVAL 90 DAY)";
	$cmd = Yii::app()->db->createCommand($query)->execute();


       	$filters = Filter::model()->findAll($args);
        foreach ($filters as $filter){
        	$this->log('info', "Processing filter !id !title \n", array('!id' => $filter->getPrimaryKey(), '!title' => $filter->title));
        	$this->exportTextFile($filter->title, $filter->getPrimaryKey());
        	$this->log('info', "Done !id !title \n", array('!id' => $filter->getPrimaryKey(), '!title' => $filter->title));
        }
    }


		// Dump the file into CSV file...
    function exportTextFile($filename, $fid) {
    	$prefix = TextHelper::utf2ascii(trim($filename), ' ', '_');
    	$date = date('Ymd', time());
    	$query ="SELECT isdn INTO OUTFILE ':outfile' LINES TERMINATED BY '\\n' FROM :table WHERE fid=:fid";

			$outfile = '/tmp/' . $date . '.isms.'.$filename . '.dk.txt';
			@unlink($outfile);
    	$cmd = Yii::app()->db->createCommand(
    			strtr($query, array(
    					':outfile' => $outfile,
    					':table'	=>	'whitelist',
    					':prefix' => $prefix,
    					':fid'	=>	$fid,
    					':date' => $date,
    			)));
    	$this->log('debug', $cmd->getText());
    	if ($cmd->execute()){
	    	echo Yii::t('app', "Done export file !file \n", array('!file' => $outfile));
    	}


			$outfile = '/tmp/' . $date . '.isms.'.$filename . '.tc.txt';
			@unlink($outfile);
    	$cmd = Yii::app()->db->createCommand(
    			strtr($query, array(
    					':outfile' => $outfile,
    					':table'	=>	'blacklist',
    					':prefix' => $prefix,
    					':fid'	=>	$fid,
    					':date' => $date,
    			)));
    	$this->log('debug', $cmd->getText());
    	if ($cmd->execute()){
	    	echo Yii::t('app', "Done export file !file \n", array('!file' => $outfile));
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
		This command line will be executed every day at 4:00AM.

		It will retrieve files from FTP, then import data files for the campaign

		Usage: FilterImport [campaign.id]';
    }

}
