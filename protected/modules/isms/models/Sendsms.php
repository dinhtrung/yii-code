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
}
