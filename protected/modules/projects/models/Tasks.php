<?php
/**
 * This is the model class for table "tasks".
 *
 * The followings are the available columns in table 'tasks':
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $title
 * @property string $description
 * @property integer $milestone
 * @property integer $project
 * @property integer $owner
 * @property string $start_date
 * @property double $duration
 * @property integer $duration_type
 * @property double $hours_worked
 * @property string $end_date
 * @property integer $status
 * @property integer $priority
 * @property integer $percent_complete
 * @property string $target_budget
 * @property string $related_url
 * @property integer $creator
 * @property integer $order
 * @property integer $client_publish
 * @property integer $dynamic
 * @property integer $access
 * @property integer $notify
 * @property string $departments
 * @property string $contacts
 * @property string $custom
 * @property integer $type
 * @property integer $createtime
 * @property integer $updatetime
 */
class Tasks extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tasks the static model class
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
		return '{{tasks}}';
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
			'milestone' => 'integer',	// 
			'project' => 'integer',	// 
			'owner' => 'integer',	// 
			'start_date' => 'string',	// 
			'duration' => 'double',	// 
			'duration_type' => 'integer',	// 
			'hours_worked' => 'double',	// 
			'end_date' => 'string',	// 
			'status' => 'integer',	// 
			'priority' => 'integer',	// 
			'percent_complete' => 'integer',	// 
			'target_budget' => 'string',	// 
			'related_url' => 'string',	// 
			'creator' => 'integer',	// 
			'order' => 'integer',	// 
			'client_publish' => 'integer',	// 
			'dynamic' => 'integer',	// 
			'access' => 'integer',	// 
			'notify' => 'integer',	// 
			'departments' => 'string',	// 
			'contacts' => 'string',	// 
			'custom' => 'string',	// 
			'type' => 'integer',	// 
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