<?php

/**

To migrate data:

Populate data for cporder table:

INSERT INTO cporder (cid, oid, smsblock) select c.id AS cid, s.id AS oid, c.blockimport AS smsblock from campaign AS c LEFT JOIN smsorder AS s ON c.orderid = s.id WHERE s.id IS NOT NULL;

Drop the campaign.orderid column

ALTER TABLE campaign DROP COLUMN orderid;

 * This is the model base class for the table "cporder".
 *
 * Columns in table "cporder" available as properties of the model:
 * @property integer $cid
 * @property integer $oid
 * @property integer $smsblock : So block SMS da gan cho chuong trinh nay....
 *
 * Relations of table "cporder" available as properties of the model:
 * @property Campaign $c
 * @property Order $o
 */
class Cporder extends BaseActiveRecord{
	public function connectionId() {
		return IsmsModule::getDbComponent();
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	* Initializes this model.
	*/
	public function init()
	{
		return parent::init();
	}
	/**
	* This magic method is used for setting a string value for the object. It will be used if the object is used as a string.
	* @return string representing the object
	*/
	public function __toString() {
		return (string) $this->id;

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{cporder}}';
	}
	/**
	 * Define validation rules
	 */
	public function rules() {
		return array_merge(parent::rules(), array(
				array( '*', 'uniqueKeys' ) ,
		));
	}
	public function uniqueKeys() {
		$this->validateCompositeUniqueKeys();
	}
	public function behaviors() {
		return array_merge(parent::behaviors() , array(
			'ECompositeUniqueKeyValidatable' => array(
				'class' => 'ext.behaviors.ECompositeUniqueKeyValidatable',
				'uniqueKeys' => array(
					'attributes' => 'oid, cid',
					'errorMessage' => Yii::t('isms', 'This worktime is already associated with this campaign') ,
				)
			) ,
		));
	}
	/**
	* Relation to other models
	*/
	public function relations()
	{
		return array(
			'c' => array(self::BELONGS_TO, 'Campaign', 'cid'),
			'o' => array(self::BELONGS_TO, 'Smsorder', 'oid'),
		);
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'cid ASC',
		);
	}

	/*
	 * CREATE TABLE IF NOT EXISTS `cpworktime` (
	 		`cid` int(11) NOT NULL COMMENT 'Campaign.id',
	 		`tid` int(11) NOT NULL COMMENT 'Worktime.id',
	 		PRIMARY KEY (`cid`,`tid`),
	 		KEY `cid` (`cid`),
	 		KEY `tid` (`tid`)
	 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	*/
	protected function createTable() {
		$columns = array(
				'cid'	=>	'int',
				'oid'	=>	'int',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('cid_oid', $this->tableName(), 'cid,oid')
		)->execute();
	}
}
