<?php

/**
 * This is the model base class for the table "cpworktime".
 *
 * Columns in table "cpworktime" available as properties of the model:
 * @property integer $id
 * @property integer $cid
 * @property integer $tid
 *
 * Relations of table "cpworktime" available as properties of the model:
 * @property Campaign $c
 * @property Worktime $t
 */
class Cpworktime extends BaseActiveRecord{
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
		return '{{cpworktime}}';
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
					'attributes' => 'tid, cid',
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
			't' => array(self::BELONGS_TO, 'Worktime', 'tid'),
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
}
