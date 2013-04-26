<?php
/**
 * This is the model class for table "tickets".
 *
 * The followings are the available columns in table 'tickets':
 * @property string $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $title
 * @property string $description
 * @property integer $company
 * @property integer $project
 * @property string $author
 * @property string $recipient
 * @property integer $attachment
 * @property string $type
 * @property string $assignment
 * @property string $activity
 * @property integer $priority
 * @property string $cc
 * @property string $signature
 * @property integer $createtime
 * @property integer $updatetime
 */
class Tickets extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tickets the static model class
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
		return '{{tickets}}';
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
			'id' => 'string',	// 
			'root' => 'integer',	// 
			'lft' => 'integer',	// 
			'rgt' => 'integer',	// 
			'level' => 'integer',	// 
			'title' => 'string',	// 
			'description' => 'string',	// 
			'company' => 'integer',	// 
			'project' => 'integer',	// 
			'author' => 'string',	// 
			'recipient' => 'string',	// 
			'attachment' => 'integer',	// 
			'type' => 'string',	// 
			'assignment' => 'string',	// 
			'activity' => 'string',	// 
			'priority' => 'integer',	// 
			'cc' => 'string',	// 
			'signature' => 'string',	// 
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