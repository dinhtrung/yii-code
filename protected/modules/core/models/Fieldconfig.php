<?php
/**
 * This is the model class for table "fieldconfig".
 *
 * The followings are the available columns in table 'fieldconfig':
 * @property string $name
 * @property string $option
 * @property string $type
 * @property string $owner
 * @property integer $rules
 */
class Fieldconfig extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Fieldconfig the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the CDbConnection component used for this module
	 */
	public function connectionId(){
		return Yii::app()->hasComponent('coreDb')?'coreDb':'db';
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{fieldconfig}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array_merge(parent::rules(), array(
			//@FIXME: Add more rules here to override default rules
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
		));
	}

	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
			'name' => 'string',	// 
			'option' => 'string',	// 
			'type' => 'string',	// 
			'owner' => 'string',	// 
			'rules' => 'integer',	// 
		);
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->addPrimaryKey('name', $this->tableName(), 'name')
		)->execute();
	}
}