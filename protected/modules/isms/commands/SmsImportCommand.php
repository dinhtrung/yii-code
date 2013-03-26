<?php
/**
 * SmsImportCommand class file.
 *
 * SQL To load data from a text file
 *
LOAD DATA LOCAL INFILE '/path/to/file.txt' REPLACE INTO TABLE send_sms
	CHARACTER SET utf8
	FIELDS TERMINATED BY "," OPTIONALLY ENCLOSED BY '"'
	LINES TERMINATED BY "\n"
	( @isdn, @csv1, @csv2 ) SET
	campaign_id=:id,
	dlr_mask=31,
	momt = 'mt',
	sms_type = 2,
	//time=NOW(), --> skip due to TIMESTAMP column...
	coding=0,
	receiver=@isdn,
	sender=:campaign.sender,
	msgdata=CONCAT('The first string send to ', @isdn, ' with 2 param: ', @csv1, ' AND ', @csv2)
	//msgdata='Or a static message template.'
 *
 */
Yii::import('isms.IsmsModule');
Yii::import('isms.models.*');
Yii::import('ext.helpers.*');
class SmsImportCommand extends CConsoleCommand
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
        if (! empty($args)) {
        	$campaigns = Campaign::model()->findAll($args);
        } else {
        	$campaigns  = Campaign::model()->findAllByAttributes(array('ready' => Campaign::READY_NOTYET, 'approved' => Campaign::APPROVED_TRUE));
        }
        foreach ($campaigns as $c){
        	$this->log('info', "Processing campaign !id !title \n", array('!id' => $c->id, '!title' => $c->title));
        	$c->setScenario("smsimport");
        	Sendsms::$cid = $c->id;
        	try {
	        	$this->downloadCampaignFtpFiles($c);
        	} catch (CException $e){
        		$this->log('warning', 'Cannot download files from FTP Server. Error: :e', array(':e' => $e->getMessage()));
        	}
        	try {
	        	$this->importDatafile($c);
        	} catch (CException $e){
        		$this->log('warning', 'Cannot import files. Error: :e', array(':e' => $e->getMessage()));
        	}
        }
        $this->filterSms();
    }

    /**
     * Main function to retrieve files from FTP
     */
    public function downloadCampaignFtpFiles(Campaign $campaign){
    	/**
    	 * @TODO: Get the FTP Settings
    	 */
    	$ftpsettings = Ftpsetting::model()->findByPk($campaign->ftpserver);
    	$filenames = Ftpfilename::model()->findAllByAttributes(array('cid' => $campaign->id));
    	foreach ($filenames as $file){
    		$ftpurl = $ftpsettings->getUrl() . $file->filename;
    		$directory = $campaign->getDirectory();
    		$destination = $directory . DIRECTORY_SEPARATOR . $file->filename;
    		if (file_exists($destination)) {
    			// Destination file already exists, generate an alternative.
    			$pos = strrpos($file->filename, '.');
    			if ($pos !== FALSE) {
    				$name = substr($file->filename, 0, $pos);
    				$ext = substr($file->filename, $pos);
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
    				$this->log('debug', "Could not get the file :name", array(':name' => $file->filename));
    			} else {
    				$this->log('debug', "Add file :name to the list of associated files.", array(':name' => $file->filename));
    				$mf = new Datafile();
    				$mf->fileProperties($destination);
    				$mf->save();
    				$cpfile = new Cpfile();
    				$cpfile->cid = $campaign->id;
    				$cpfile->fid = $mf->id;
    				$cpfile->status = Cpfile::STATUS_NEW;
   		    	}
   		    	curl_close($ch);
    		}
    	}
    	/**
    	 * Set campaign status for import data
    	 */
    	$campaign->ready = Campaign::READY_NOTYET;
    	$campaign->update();
    }



    /**
     * Function to import CSV file
     */
     function importDatafile(Campaign $campaign){
		 if (empty($campaign->template)) return;
		 $this->log('info', 'Import Data files for [:id] :title', array(':id' => $campaign->id, ':title' => $campaign->title));
    	$fields = array();
    	for ($i = 1; $i <= $campaign->col; $i++){
    		if ($i == $campaign->isdncol) $fields[] = 'isdn';
    		else $fields[] = "csv$i";
    	}

    	$template = $campaign->template;
    	$sql_fields_str = '@' . implode(', @', $fields);
    	//$template = str_replace("'", "\'", $template);
    	//$template = str_replace('"', '\"', $template);
    	$sql_template = $template = urlencode($template);

    	foreach($fields as $var) {
    		if ($var == 'none') continue;
    		$sql_template = str_replace(urlencode('{' . $var . '}'), '", @' . $var . ', "', $sql_template);
    	}
    	if ($template != $sql_template) $template = 'CONCAT("' . $sql_template . '")';
    	else $template = "'" . $sql_template . "'";

    	$query = 'LOAD DATA LOCAL INFILE \'%importfile\' REPLACE INTO TABLE %table CHARACTER SET utf8 FIELDS TERMINATED BY "," OPTIONALLY ENCLOSED BY \'"\' LINES TERMINATED BY "\n"';
		$query.= " ( $sql_fields_str ) SET campaign_id=%nid, dlr_mask=31, momt = 'mt', dlr_url='', time=NOW(), sms_type=2, coding=0, charset='UTF-8', receiver=CAST(@isdn AS UNSIGNED), sender='%sender', msgdata=$template";

		/**
		 * @TODO: Find All files for this campaigns...
		 */
		$files = Cpfile::model()->findAllByAttributes(array('status' => Cpfile::STATUS_NEW, 'cid' => $campaign->id));
		Cpfile::model()->updateAll(
			array('status' => Cpfile::STATUS_PROCESSING, 'cid' => $campaign->id),
			'status=:status AND cid=:cid',
			array(':status' => Cpfile::STATUS_NEW, ':cid' => $campaign->id)
		);

		// Begin Importing...
		//$campaign->ready = Campaign::READY_IMPORT;
		if ($campaign->saveAttributes(array('ready' => Campaign::READY_IMPORT)))
			$this->log('info', "Change status for campaign [:id] :title to Ready :ready, Active :active, Status :status before process list of files...", array(
									':id'	=>	$campaign->id,
									':title'	=>	$campaign->title,
									':ready'	=>	$campaign->ready,
									':active'	=>	$campaign->active,
									':status'	=>	$campaign->status,
			));
		else
			$this->log('error', var_export($campaign->getErrors(), TRUE));
		// loop all files...
		foreach ($files as $cpf){
			$this->log('info', "Proccessing file :path", array(':path' => $filepath = $cpf->f->fileUri2Path()));
			CVarDumper::dump($cpf->f->getAttributes());
			// Textfile?
			if ((in_array($cpf->f->filemime, $this->textMimeTypes)) OR (in_array($cpf->f->filemime, $this->csvMimeTypes))){
				$this->log('info', "Prepare to import file !file", array('!file' => $cpf->f->fileUri2Path()));

				// Convert to UNIX format
				$mv = TRUE;
				$datafile = escapeshellarg($cpf->f->fileUri2Path());
				$cmd = escapeshellcmd("dos2unix $datafile");
				system($cmd, $cmdout);
				$this->log('info', "Command executed:\n:cmd\n\tOutput::out", array(':cmd' => $cmd, ':out' => $cmdout));

				// Stupid excel encoding....
				$cmd = "col -b < $datafile > /tmp/datafile.txt 2>&1";
				system($cmd, $cmdout);
				if ($cmdout != 0){
					$this->log('error', "Command executed:\n:cmd\n\tOutput::out", array(':cmd' => $cmd, ':out' => $cmdout));
					// Try again using iconv....
					$cmd = "iconv -f UTF-16 -t ASCII $datafile > /tmp/datafile.txt 2>&1";
					system($cmd, $cmdout);

					if ($cmdout){		// error again???
						$mv = FALSE;
						$this->log('error', 'There is no way I could convert this file: '. $datafile);
					} else {
						$this->log('info', "Successfully convert using iconv:\n".$cmd."\n");
					}
				}

				if ($mv){
					$cmd = escapeshellcmd("mv /tmp/datafile.txt $datafile");
					system($cmd, $cmdout);
					$this->log('info', "Command executed:\n:cmd\n\tOutput::out", array(':cmd' => $cmd, ':out' => $cmdout));
				}

				$table = Sendsms::model()->tableName();

				$cmd = Yii::app()->db->createCommand(
					strtr($query, array(
						'%importfile'	=>	$cpf->f->fileUri2Path(),
						'%table'	=>	$table,
						'%sender'	=>  $campaign->sender,
						'%nid'		=>	$campaign->id,
					)));
				$this->log('debug', $cmd->getText());
				$cmd->execute();

				$cid = $campaign->id;

				$cmd = Yii::app()->db->createCommand("UPDATE IGNORE $table SET receiver = CONCAT('84', SUBSTRING(receiver, 2)) WHERE campaign_id=$cid AND receiver LIKE '0%'")->execute();
				$cmd = Yii::app()->db->createCommand("UPDATE IGNORE $table SET receiver = CONCAT('84', receiver) WHERE campaign_id=$cid AND (receiver LIKE '1%' OR receiver LIKE '9%')")->execute();

				$cmd = Yii::app()->db->createCommand("DELETE FROM send_sms WHERE campaign_id=$cid AND ((receiver NOT REGEXP '^849[03][0-9]{7}$') AND (receiver NOT REGEXP '^8412[01268][0-9]{7}$'))")->execute();
/* allowed prefix  8490;8493;84120;84121;84122;84126;84128 */
				// $cmd = Yii::app()->db->createCommand("DELETE FROM send_sms WHERE campaign_id=$cid AND NOT((receiver like '8490%') OR (receiver like '8493%') OR (receiver like '84120%') OR (receiver like '84121%') OR (receiver like '84122%') OR (receiver like '84126%') OR (receiver like '84128%'))")->execute();	
				echo Yii::t('app', "Done import file !file \n", array('!file' => $cpf->f->filename));
			}
			/**
			 * ZIP files
			 */
			elseif (in_array($cpf->f->filemime, $this->zipMimeTypes) ){
				$this->log('info', "Processing ZIP file :zip for campaign [:id]",
					array(':zip' => $cpf->f->filename, ':id' => $campaign->id));
				$file = $cpf->f->fileUri2Path();
				if (! empty($file)) {
					$basename = pathinfo($file, PATHINFO_FILENAME);
					$zip = new EZip();
					$zip->extractZip($file, $dest = $campaign->getDirectory());
					$zipfiles = $zip->lsZip($file);
					foreach ($zipfiles as $filename){
						$m = new Datafile();
						$m->title = $cpf->f->filename . ' > ' . $filename;
						$m->description = Yii::t('app', "Extracted File from ZIP %zipfile \n", array('%zipfile' => $cpf->f->filename));
						$m->fileProperties($dest . DIRECTORY_SEPARATOR . $filename);
						$m->save();
						$c = new Cpfile();
						$c->fid = $m->fid;
						$c->cid = $campaign->id;
						$c->status = Cpfile::STATUS_NEW;
						$c->save();
					}
					// Reset campaign ready field, to begin import files downloaded...
					if ($campaign->saveAttributes(array('ready' => Campaign::READY_NOTYET)))
						$this->log('info', "Change status for campaign :title to Ready :ready, Active :active, Status :status after extract ZIP file", array(
							':title'	=>	$campaign->title,
							':ready'	=>	$campaign->ready,
							':active'	=>	$campaign->active,
							':status'	=>	$campaign->status,
						));
					else
						$this->log('error', var_export($campaign->getErrors(), TRUE));
				}
			}
			$cpf->status = Cpfile::STATUS_PROCESSED;
			if ($cpf->save()){
				$this->log('info', 'Successfully process file [fid].', array('fid' => $cpf->fid));
			} else {
				$this->log('error', 'File [fid] proccessed but system cannot change its status.', array('fid' => $cpf->fid));
			}
		}
    }

	/**
	 * Filter SMS Messages
	 */
    function filterSms(){
    	$campaigns  = Campaign::model()->findAllByAttributes(array('ready' => Campaign::READY_IMPORT));

    	foreach ($campaigns as $campaign){
    		$cid = $campaign->id;
    		$campaign->setScenario("filtersms");
			Sendsms::$cid = $cid;
	    	$this->log('info', "Filter SMS Campaign [:id] :title to Ready :ready, Active :active, Status :status", array(
	    							':id'		=>	$campaign->id,
	    							':title'	=>	$campaign->title,
	    							':ready'	=>	$campaign->ready,
	    							':active'	=>	$campaign->active,
	    							':status'	=>	$campaign->status,
	    	));
	    	$fids = array();
	    	foreach ($campaign->filters as $cpfilter){
	    		$fids[$cpfilter->type][] = $cpfilter->fid;
	    	}
	    	$queries = array();
	    	@unlink("/tmp/filtered_$cid.csv");
	    	foreach ($fids as $type => $ids){
	    		if ($type == 0){
	    			// ISTT: Xuat danh sach thue bao bi loc bo
	    			$qry = strtr(
	    				"SELECT receiver INTO OUTFILE '/tmp/filtered_$cid.csv' LINES TERMINATED BY '\\n' FROM :send_sms_table WHERE campaign_id=$cid AND receiver IN (SELECT isdn FROM blacklist WHERE fid IN (:ids))"
			  			, array(
								':send_sms_table'	=>	Sendsms::model()->tableName(),
								':ids'	=>	implode(',', $ids),
							));
	    			$cmd = Yii::app()->db->createCommand($qry);
	    			$this->log('debug', $cmd->getText());
	    			$cmd->execute();
	    			// ISTT: Xoa danh sach thue bao bi loc bo
	    			$qry = strtr(
	    				"DELETE FROM :send_sms_table WHERE campaign_id=$cid AND receiver IN (SELECT DISTINCT isdn FROM blacklist WHERE fid IN (:ids))"
			  			, array(
								':send_sms_table'	=>	Sendsms::model()->tableName(),
								':ids'	=>	implode(',', $ids),
							));
	    			$cmd = Yii::app()->db->createCommand($qry);
	    			$this->log('debug', $cmd->getText());
	    			$cmd->execute();
	    		} elseif ($type == 1){
	    			// ISTT: Them danh sach blacklist vao
	    			$qry = strtr(
	    				"INSERT INTO :send_sms_table (receiver, msgdata, sender, campaign_id, dlr_mask, coding, charset) SELECT DISTINCT isdn AS receiver, URLENCODE('" . $campaign->template . "') AS msgdata,	'". $campaign->sender."' AS sender,	'". $campaign->id."' AS campaign_id,	'31' AS dlr_mask,	'0' AS coding, 'UTF-8' AS charset FROM whitelist WHERE fid IN (:ids)"
			  			, array(
								':send_sms_table'	=>	Sendsms::model()->tableName(),
								':ids'	=>	implode(',', $ids),
							));
	    			$cmd = Yii::app()->db->createCommand($qry);
	    			$this->log('debug', $cmd->getText());
	    			$cmd->execute();
	    		}
	    	}

	    	// Nen file danh sach khach hang da loc va luu vao thu muc thich hop
	    	exec("tar -czvf /var/www/isms/results/filtered_$cid.tar.gz /tmp/filtered_$cid.csv");
		  	exec("chown apache:apache /var/www/isms/results/filtered_$cid.tar.gz");
		  	@unlink("/tmp/filtered_$cid.csv");

	    	// Calculate campaign SMS count and save it...
	    	$campaign->smsimport = Sendsms::model()->count('campaign_id = :id', array(':id' => $campaign->id)) + Sentsms::model()->count('campaign_id = :id', array(':id' => $campaign->id));
    		$campaign->blockimport = Yii::app()->db->createCommand( "SELECT SUM(CEIL(CHAR_LENGTH(URLDECODE(msgdata))/160)) AS count FROM {{send_sms}} WHERE campaign_id = :id")->queryScalar(array(':id' => $campaign->id));
	    	/** @FIXME: Fix quota here... **/
	    	$orders = Cporder::model()->findAllByAttributes(array('cid' => $campaign->id));
	    	$quota = 0;
	    	foreach ($orders as $o){
	    		$quota += $o->o->getSmsleft();
	    	}
	    	echo "Quota: $quota \n";
	    	echo "Blockimport: {$campaign->blockimport} \n";
	    	if ($campaign->blockimport > $quota)
	    		$campaign->limit_exceeded = Campaign::LIMIT_EXCEEDED;
	    	else {
	    		$q = $campaign->blockimport;
	    		foreach ($orders as $o){
	    			$t = $o->o->getSmsleft();	// so block SMS con lai cua don hang
			  		if ($t <= $q){		// Don hang khong du?
			  			$o->smsblock = $t;
			  		} else {
			  			$o->smsblock = $q;	// Don hang du?
			  		}
					$q -= $o->smsblock;
			  		$o->save();
			  	}
			  	$campaign->limit_exceeded = Campaign::LIMIT_AVAILABLE;
	    	}
	    	$campaign->ready = Campaign::READY_ALL;
	    	if ($campaign->update())
		    	$this->log('info', "Change status for campaign [id] title to Ready ready, Active active, Status status Smsimport: smsimport Blockimport blockimport Limit limit_exceeded", $campaign->getAttributes());
	    	else $this->log('error', var_export($campaign->getErrors(), TRUE));
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
