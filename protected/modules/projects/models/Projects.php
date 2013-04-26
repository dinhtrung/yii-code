<?php
/**
 * This is the model class for table "projects".
 *
 * The followings are the available columns in table 'projects':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $alias
 * @property double $target_budget
 * @property double $actual_budget
 * @property string $start_date
 * @property string $end_date
 * @property integer $priority
 * @property integer $private
 * @property integer $status
 * @property integer $percent_complete
 * @property integer $department
 * @property string $url
 * @property string $demo_url
 * @property integer $author
 * @property integer $editor
 * @property integer $owner
 * @property integer $createtime
 * @property integer $updatetime
 */
class Projects extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Projects the static model class
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
		return '{{projects}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'contacts' => array(self::HAS_MANY, 'ProjectContact', 'pid'),
			'departments' => array(self::HAS_MANY, 'ProjectDepartment', 'pid'),
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
			'title' => 'string',	// Ten du an
			'description' => 'string',	// Mo ta cho du an
			'alias' => 'string',	// Machine name cho du an
			'target_budget' => 'double',	//
			'actual_budget' => 'double',	//
			'start_date' => 'string',	//
			'end_date' => 'string',	//
			'priority' => 'integer',	//
			'private' => 'integer',	//
			'status' => 'integer',	//
			'percent_complete' => 'integer',	//
			'department' => 'integer',	//
			'url' => 'string',	//
			'demo_url' => 'string',	//
			'author' => 'integer',	//
			'editor' => 'integer',	//
			'owner' => 'integer',	//
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




	protected function beforeSave(){
		if ($this->isNewRecord)
			$this->author = (Yii::app()->user)?Yii::app()->user->id:NULL;
		$this->editor = (Yii::app()->user)?Yii::app()->user->id:NULL;
		return parent::beforeSave();
	}
}