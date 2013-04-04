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
class TestSmsCommand extends CConsoleCommand
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
    	$cids = array(207, 208, 210, 214, 215, 220, 221, 222, 223, 224, 225, 226, 227, 228, 229, 230, 231, 232, 240, 241, 245, 253, 254, 255, 256, 257, 258, 259, 260, 261, 262, 263, 264, 265, 267, 268, 269, 272, 276, 277, 279, 280, 281, 282, 284, 287, 295, 317, 325, 327, 334, 335, 340, 341, 343, 347, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 359, 363, 365, 366, 368, 369, 373, 376, 378, 379, 380, 398, 414, 415, 417, 418, 419, 420, 421, 428, 430, 432, 434, 438, 439, 440, 443, 445, 446, 447, 458, 459, 465, 466, 467, 468, 469, 470, 471, 472, 473, 475, 476, 477, 487, 489, 490, 491, 492, 493, 494, 496, 498, 499, 503, 504, 505, 506, 510, 511, 513, 514, 515, 518, 519, 529, 530, 544, 545, 552, 553, 554, 555, 556, 563, 564, 565, 570, 571, 572, 573, 574, 577, 578, 579, 585, 586, 589, 590, 591, 592, 593, 594, 600, 601, 602, 604, 605, 606, 607, 610, 617, 623, 632, 638, 640, 644, 658, 680, 687, 689, 690, 707, 709);

    	foreach ($cids as $campaign_id){
    		$blockimport =
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
