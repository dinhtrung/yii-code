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
	// @ISTT: Lenh nay se duoc chay hang ngay. Update lai cac chuong trinh trong 3 ngay gan nhat...
	$cmd = Yii::app()->db->createCommand("UPDATE campaign SET sent=NULL, blocksent=NULL where start > DATE_SUB(NOW(), INTERVAL 3 DAY)")->execute();
	$campaigns = Campaign::model()->findAll();
	foreach ($campaigns as $cp){
		$this->log('info', "Campaign ".$cp->title." Has sent ".$cp->getSent()." - ".$cp->getBlocksent());
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
