<?php

/**
 * This is the model class for table "dailyreport".
 *
 * The followings are the available columns in table 'dailyreport':
 * @property integer $id_dailyreport
 * @property string $created_date
 * @property integer $sms_sent
 * @property integer $block_sent
 * @property integer $sms_delivered
 * @property integer $block_delivered
 * @property integer $campaign_id
 */
class Dailyreport extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Dailyreport the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{dailyreport}}';
	}


	public function init(){
		parent::init();
	}

	public function connectionId() {
		return IsmsModule::getDbComponent();
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'c'	=>	array(self::BELONGS_TO, 'Campaign', 'campaign_id'),
		);
	}

	/**
	 * Default scope
	 */
	public function defaultScope(){
		return array(
			'order'	=>	'created_date DESC',
		);
	}
}