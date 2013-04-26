<?php
/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $title
 * @property string $description
 * @property string $start_date
 * @property string $end_date
 * @property string $times_recuring
 * @property string $recurs
 * @property string $remind
 * @property string $icon
 * @property integer $owner
 * @property integer $project
 * @property integer $private
 * @property integer $type
 * @property integer $cwd
 * @property integer $notify
 * @property integer $createtime
 * @property integer $updatetime
 */
class Events extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Events the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the CDbConnection component used for this module
	 */
	public function connectionId(){
		return Yii::app()->hasComponent('projectsDb')?'projectsDb':'db';
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{events}}';
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
			'id' => 'integer',	// 
			'root' => 'integer',	// 
			'lft' => 'integer',	// 
			'rgt' => 'integer',	// 
			'level' => 'integer',	// 
			'title' => 'string',	// 
			'description' => 'string',	// 
			'start_date' => 'string',	// 
			'end_date' => 'string',	// 
			'times_recuring' => 'string',	// 
			'recurs' => 'string',	// 
			'remind' => 'string',	// 
			'icon' => 'string',	// 
			'owner' => 'integer',	// 
			'project' => 'integer',	// 
			'private' => 'integer',	// 
			'type' => 'integer',	// 
			'cwd' => 'integer',	// 
			'notify' => 'integer',	// 
			'createtime' => 'integer',	// 
			'updatetime' => 'integer',	// 
		);
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->addPrimaryKey('id', $this->tableName(), 'id')
		)->execute();
	}
}