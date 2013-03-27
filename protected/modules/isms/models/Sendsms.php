<?php
/**
 * This is the model base class for the table "send_sms".
 *
 * Columns in table "send_sms" available as properties of the model:
 * @property string $sql_id
 * @property string $momt
 * @property string $sender
 * @property string $receiver
 * @property string $udhdata
 * @property string $msgdata
 * @property string $time
 * @property string $smsc_id
 * @property string $service
 * @property string $account
 * @property string $id
 * @property string $sms_type
 * @property string $mclass
 * @property string $mwi
 * @property string $coding
 * @property string $compress
 * @property string $validity
 * @property string $deferred
 * @property string $dlr_mask
 * @property string $dlr_url
 * @property string $pid
 * @property string $alt_dcs
 * @property string $rpi
 * @property string $charset
 * @property string $boxc_id
 * @property string $binfo
 * @property string $campaign_id
 *
 * There are no model relations.
 */
class Sendsms extends BaseActiveRecord {

	public static $cid;
	public function connectionId() {
		return IsmsModule::getDbComponent();
	}
	public function __construct($scenario = 'insert') {
			parent::__construct($scenario);
	}
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	/**
	 * Initializes this model.
	 */
	public function init() {
		return parent::init();
	}
	/**
	 * This magic method is used for setting a string value for the object. It will be used if the object is used as a string.
	 * @return string representing the object
	 */
	public function __toString() {
		return (string)Yii::t('isms', "!time: !sender -> !receiver '!msgdata'", array('!time' => $this->time, '!sender' => $this->sender, '!receiver' => $this->receiver, '!msgdata' => $this->msgdata));
	}
	/**
	 * @return string name of the class table
	 */
	public function tableName() {
		return '{{send_sms}}';
	}

	/**
	 * Relation to other models
	 */
	public function relations() {
		return array(
			'c'	=>array(self::BELONGS_TO, 'Campaign', 'campaign_id'),
		);
	}
	/*
	 * Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'time DESC',
		);
	}

	public function rules() {
		return array_merge(
			parent::rules(),
			array(
				array('meta_data', 'safe') ,
			)
		);
	}


	/*!50100 PARTITION BY HASH (campaign_id)
	CREATE TABLE IF NOT EXISTS `sent_sms` (
	`momt` enum('MO','MT','DLR','3rd') DEFAULT NULL,
	`sender` varchar(20) DEFAULT NULL,
	`receiver` varchar(20) NOT NULL DEFAULT '',
	`udhdata` blob,
	`msgdata` text,
	`time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`smsc_id` varchar(255) DEFAULT NULL,
	`service` varchar(255) DEFAULT NULL,
	`account` varchar(255) DEFAULT NULL,
	`id` bigint(20) DEFAULT NULL,
	`sms_type` bigint(20) DEFAULT NULL,
	`mclass` bigint(20) DEFAULT NULL,
	`mwi` bigint(20) DEFAULT NULL,
	`coding` bigint(20) DEFAULT NULL,
	`compress` bigint(20) DEFAULT NULL,
	`validity` bigint(20) DEFAULT NULL,
	`deferred` bigint(20) DEFAULT NULL,
	`dlr_mask` bigint(20) DEFAULT NULL,
	`dlr_url` varchar(255) DEFAULT NULL,
	`pid` bigint(20) DEFAULT NULL,
	`alt_dcs` bigint(20) DEFAULT NULL,
	`rpi` bigint(20) DEFAULT NULL,
	`charset` varchar(255) DEFAULT NULL,
	`boxc_id` varchar(255) DEFAULT NULL,
	`binfo` varchar(255) DEFAULT NULL,
	`campaign_id` int(9) NOT NULL DEFAULT '0',
	`bearerbox_id` varchar(20) DEFAULT NULL,
	PRIMARY KEY (`campaign_id`,`receiver`)
	*/
	protected function createTable() {
		$columns = array(
				'time'	=>	'datetime',
				'sender'	=>	'string',
				'receiver'	=>	'int',
				'msgdata'	=>	'text',
				'campaign_id'	=>	'int',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createIndex('sms_campaign', $this->tableName(), 'campaign_id,sender,receiver', TRUE)
		)->execute();
	}
}
