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
class Sentsms extends Sendsms {
	public function connectionId() {
		return IsmsModule::getDbComponent();
	}
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	public function tableName() {
		return '{{sent_sms}}';
	}
}
