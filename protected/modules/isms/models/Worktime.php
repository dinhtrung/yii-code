<?php

/**
 * This is the model base class for the table "worktime".
 *
 * Columns in table "worktime" available as properties of the model:
 * @property integer $id
 * @property string $start
 * @property string $end
 *
 * Relations of table "worktime" available as properties of the model:
 * @property Cpworktime[] $cpworktimes
 */
class Worktime extends BaseActiveRecord{
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
		return (string) $this->start . ' - ' . $this->end;
	}

	public function getTime() {
		return (string) $this->start . ' - ' . $this->end;
	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{worktime}}';
	}
	/**
	* Relation to other models
	*/
	public function relations()
	{
		return array(
			'cpworktimes' => array(self::HAS_MANY, 'Cpworktime', 'tid'),
		);
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'start ASC',
		);
	}
}
