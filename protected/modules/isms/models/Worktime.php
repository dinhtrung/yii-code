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

	/**
	 * Extra rules for validation
	 */
	public function rules()
	{
		return array_merge(parent::rules(), array(
				array('*', 'uniqueKeys'),
		));
	}

	/*
	 * Add UniqueKey behaviors
	 */
	public function uniqueKeys() {
		$this->validateCompositeUniqueKeys();
	}
	public function behaviors() {
		return array_merge(parent::behaviors() , array(
				'ECompositeUniqueKeyValidatable' => array(
						'class' => 'ext.behaviors.ECompositeUniqueKeyValidatable',
						'uniqueKeys' => array(
								'attributes' => 'start, end',
								'errorMessage' => Yii::t('isms', 'This work time is already defined.') ,
						)
				) ,
		));
	}

	/*
	 *
	 */
	protected function createTable(){
		$columns = array(
		 		'start'	=>	'string',
		 		'end'	=>	'string',
		 );
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('start_end', $this->tableName(), 'start,end')
		)->execute();
	}

}
