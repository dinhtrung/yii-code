<?php
/**
 * ImportCdrCommand class file.
 *
 * @author Jon Doe <jonny@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * ImportCdrCommand is ...
 *
 *
 * @author Jon Doe <jonny@gmail.com>
 * @version
 * @package
 * @since 1.0
 */
class ImportCdrCommand extends CConsoleCommand
{
	public $path = '/var/www/chargingMenu';
	/**
	 * Executes the command.
	 * @param array command line parameters for this command.
	 */
    public function run($args)
    {
        // $args gives an array of the command-line arguments for this command
        if (! empty($args[0])) $this->path = $args[0];

        // The query to run against
        $query = 'LOAD DATA LOCAL INFILE ":file" REPLACE INTO TABLE cdr CHARACTER SET utf8 FIELDS TERMINATED BY ":" OPTIONALLY ENCLOSED BY \'"\' LINES TERMINATED BY "\n" (time, a_number, b_number, eventid, cpid, contentid, status, cost , channeltype , information)';

	// Processed files
	$processed = Yii::app()->db->createCommand('SELECT filename FROM processed')->queryAll();
	foreach ($processed as $k => $fn) $processed[$k] = $fn['filename'];

        $cdrfiles = CFileHelper::findFiles($this->path, array('fileTypes' => array('cdr')));
        foreach ($cdrfiles as $filepath){
		$filename = basename($filepath);
		if (in_array($filename, $processed)) {
			echo "Skip file: ".$filename."\n";
			continue;
		}
        	echo Yii::t('import-cdr', "Prepare to import file ':file'\n",array(':file' => $filename));
		$sql = strtr($query, array(':file' => $filepath));
        	try {

			Yii::app()->db->createCommand($sql)->execute();
		} catch (CDbException $e){
			mysql_connect('localhost', 'root', 'istt!2#', false, 128);
			mysql_select_db('yii_core');
//			mysql_set_charset('utf8');
			mysql_query($sql);
		}
		Yii::app()->db->createCommand()->insert('processed', array('filename' => $filename));
        	echo "Done...\n";
        }
    }
	/**
	 * Provides the command description.
	 * This method may be overridden to return the actual command description.
	 * @return string the command description. Defaults to 'Usage: php entry-script.php command-name'.
	 */
    public function getHelp()
    {
        return 'Usage: cdrimport [path]';
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
