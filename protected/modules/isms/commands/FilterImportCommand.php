<?php
/**
 * FilterImportCommand class file.
 *
 * SQL To load data from a text file
 *

LOAD DATA LOCAL INFILE '/path/to/file.txt' REPLACE INTO TABLE blacklist[whitelist]
	CHARACTER SET utf8
	FIELDS TERMINATED BY "," OPTIONALLY ENCLOSED BY '"'
	LINES TERMINATED BY "\n"
	( @isdn ) SET
	isdn=@isdn,
	fid=:filterid
 *
 */
Yii::import('isms.IsmsModule');
Yii::import('isms.models.*');
Yii::import('ext.helpers.*');
class FilterImportCommand extends CConsoleCommand
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
        // $args gives an array of the command-line arguments for this command
        if (! empty($args)) {
        	$filters = Filter::model()->findAll($args);
        } else {
        	$filters  = Filter::model()->findAll('ftpblack IS NOT NULL OR ftpwhite IS NOT NULL');
        }
        $blackfilenames = array(); // File to import and remove afterwards
        $blackremoves = array();
        $whitefilenames = array(); // File to import and remove afterwards
        $whiteremoves = array();
        foreach ($filters as $filter){
        	$this->log('info', "Processing filter !id !title \n", array('!id' => $filter->getPrimaryKey(), '!title' => $filter->title));
        	try {
						if (is_object($filter->ftpblacklist)){
							  $blackfile = strftime($filter->ftpblackfile);
								$blackurl = $filter->ftpblacklist->getUrl() . $blackfile;
								$directory = $filter->getDirectory();
								$blackfilenames[$this->downloadFilterFtpFiles($blackurl, $blackfile, $directory)] = $filter->getPrimaryKey();
								$blackremoves[$filter->getPrimaryKey()] = TRUE;
						}
        	} catch (CException $e){
        		$this->log('info', 'Got error: ' . $e->getMessage());
        	}
        	try {
						if (is_object($filter->ftpwhitelist)){
	        	$whitefile = strftime($filter->ftpwhitefile);
				  	$whiteurl = $filter->ftpwhitelist->getUrl() . $whitefile;
				  	$directory = $filter->getDirectory();
				  	$whitefilenames[$this->downloadFilterFtpFiles($whiteurl, $whitefile, $directory)] = $filter->getPrimaryKey();
				  	$whiteremoves[$filter->getPrimaryKey()] = TRUE;
        	}} catch (CException $e){
        		$this->log('info', 'Got error: ' . $e->getMessage());
        	}
        }
        $query = "DELETE FROM :table WHERE fid IN (:fid)";
        $cmd = Yii::app()->db->createCommand(
    			strtr($query, array(
    					':fid'	=>	implode(', ', array_keys($blackremoves)),
    					':table'	=>  'blacklist',
    			)));
    	$this->log('debug', $cmd->getText()); $cmd->execute();
        $cmd = Yii::app()->db->createCommand(
    			strtr($query, array(
    					':fid'	=>	implode(', ', array_keys($whiteremoves)),
    					':table'	=>  'whitelist',
    			)));
    	$this->log('debug', $cmd->getText()); $cmd->execute();

        foreach ($blackfilenames  as $infile => $fid) $this->importDatafile($infile, $fid, 'blacklist');
        foreach ($whitefilenames  as $infile => $fid) $this->importDatafile($infile, $fid, 'whitelist');
        if (YII_DEBUG) CVarDumper::dump(Yii::getLogger()->getProfilingResults());
    }

    /**
     * Main function to retrieve files from FTP
     */
    public function downloadFilterFtpFiles($ftpurl, $filename, $directory){
    	$destination = $directory . DIRECTORY_SEPARATOR . $filename;
    	if (file_exists($destination)) {
    		$pos = strrpos($filename, '.');
    		if ($pos !== FALSE) {
    			$name = substr($filename, 0, $pos);
    			$ext = substr($filename, $pos);
    		}
    		else {
    			$name = $filename;
    			$ext = '';
    		}

    		$counter = 0;
    		do {
    			$destination = $directory . DIRECTORY_SEPARATOR . $name . '_' . $counter++ . $ext;
    		} while (file_exists($destination));
    	}

    	$this->log('info', 'Download URL: [ :ftpurl ] to [:destination]', array(':ftpurl' => $ftpurl, ':destination' => $destination));

    	$ch = curl_init($ftpurl);
    	if (!($fh = fopen($destination, 'w'))) {
    		$this->log('error', 'Failed to create new file [:dest]', array(':dest' => $destination));
    	} else {
    		curl_setopt($ch, CURLOPT_FILE, $fh);
    		if (curl_exec($ch) === FALSE) {
    			$this->log('debug', "Could not get the file :name", array(':name' => $filename));
    			fclose($fh);
    			@unlink($destination);
    		} else {
    			$this->log('debug', "Successfully download file :name ", array(':name' => $filename));
    			curl_close($ch);
    			fclose($fh);
    			return $destination;
   		    }
   		    curl_close($ch);
    	}
    }

    function importTextFile($infile, $fid, $table) {

    	$mv = TRUE;
    	$datafile = escapeshellarg($infile);
			$cmd = escapeshellcmd("dos2unix $datafile");
			system($cmd, $cmdout);
			$this->log('info', "Command executed:\n:cmd\n\tOutput::out", array(':cmd' => $cmd, ':out' => $cmdout));

			// Stupid excel encoding....
			$cmd = "col -b < $datafile > /tmp/filterdata.txt 2>&1";
			system($cmd, $cmdout);
			if ($cmdout != 0){
				$this->log('error', "Command executed:\n:cmd\n\tOutput::out", array(':cmd' => $cmd, ':out' => $cmdout));
				// Try again using iconv....
				$cmd = "iconv -f UTF-16 -t ASCII $datafile > /tmp/filterdata.txt 2>&1";
				system($cmd, $cmdout);

				if ($cmdout){		// error again???
					$mv = FALSE;
					$this->log('error', 'There is no way I could convert this file: '. $datafile);
				} else {
					$this->log('info', "Successfully convert using iconv:\n".$cmd."\n");
				}
			}

			if ($mv){
					$cmd = escapeshellcmd("mv /tmp/filterdata.txt $datafile");
					system($cmd, $cmdout);
					$this->log('info', "Command executed:\n:cmd\n\tOutput::out", array(':cmd' => $cmd, ':out' => $cmdout));
				}

    	$query = 'LOAD DATA LOCAL INFILE \':infile\' REPLACE INTO TABLE :table
    	CHARACTER SET utf8
    	FIELDS TERMINATED BY "," OPTIONALLY ENCLOSED BY \'"\'
    	LINES TERMINATED BY "\n"
    	( @isdn ) SET
    	isdn=CAST(@isdn AS UNSIGNED),
    	fid=:fid';
    	$cmd = Yii::app()->db->createCommand(
    			strtr($query, array(
    					':infile'	=>	$infile,
    					':fid'	=>	$fid,
    					':table'	=>  $table,
    			)));
    	$this->log('debug', $cmd->getText());
    	if ($cmd->execute()){
	    	echo Yii::t('app', "Done import file !file \n", array('!file' => $infile));
    	}
    }

    /**
     * Function to import CSV file
     */
     function importDatafile($infile, $fid, $table){
     	if (! file_exists($infile)) return;

     	$mime = CFileHelper::getMimeType($infile);
     	if ((in_array($mime, $this->textMimeTypes)) OR (in_array($mime, $this->csvMimeTypes))){
			$this->importTextFile($infile, $fid, $table);
		}
		/**
		 * ZIP files
		 */
		elseif (in_array($mime, $this->zipMimeTypes) ){
			$this->log('info', "Processing ZIP file :zip for filter [:id]",
				array(':zip' => $infile, ':id' => $fid));
			if (! empty($infile)) {
				$basename = pathinfo($infile, PATHINFO_FILENAME);
				$dest = pathinfo($infile, PATHINFO_DIRNAME);
				$zip = new EZip();
				$zip->extractZip($infile, $dest);
				$zipfiles = $zip->lsZip($infile);
				foreach ($zipfiles as $filename){
					$this->importDatafile($dest . DIRECTORY_SEPARATOR . $filename, $fid, $table);
				}
			}
		} else {
			$this->log('info', "Cannot proccess file :file with mime :mime", array(':file' => $infile, ':mime' => $mime));
		}
		@unlink($infile);
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
