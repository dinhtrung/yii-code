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
class DatafileDeleteCommand extends CConsoleCommand
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
    	$date = time() - 90 * 24 * 3600;
    	$datafiles = Datafile::model()->findAll("createtime < $date");
    	foreach ($datafiles as $datafile){
    		$this->log("info", "Processing datafile ". $datafile->title . ' created '.date('Y-m-d H:i:s', $datafile->createtime));
    		$datafile->delete();
    	}

    	$datedmy = date('Y-m-d H:i:s', $date);
    	$campaigns = Campaign::model()->findAll("end < '$datedmy' AND emailbox != NULL");
    	foreach ($campaigns as $cp){
    		$this->log('info', "Processing campaign " . $cp->title . ' expired in '.$cp->end);
    		$cp->delete();
    	}

    	$smsorders = Smsorder::model()->findAll("expired < '$datedmy'");
    	foreach ($smsorders as $order){
    		$this->log('info', "Processing order " . $order->title . ' expired in '.$order->expired);
    		$order->delete();
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
