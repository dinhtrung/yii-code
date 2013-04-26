<?php
/**
 * This is the model class for table "files".
 *
 * The followings are the available columns in table 'files':
 * @property integer $id
 * @property string $real_filename
 * @property integer $folder
 * @property integer $project
 * @property integer $task
 * @property string $name
 * @property string $description
 * @property string $type
 * @property integer $owner
 * @property string $date
 * @property integer $size
 * @property double $version
 * @property string $icon
 * @property integer $category
 * @property string $checkout
 * @property string $co_reason
 * @property integer $version_id
 */
class Files extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Files the static model class
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
		return '{{files}}';
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
			'real_filename' => 'string',	// 
			'folder' => 'integer',	// 
			'project' => 'integer',	// 
			'task' => 'integer',	// 
			'name' => 'string',	// 
			'description' => 'string',	// 
			'type' => 'string',	// 
			'owner' => 'integer',	// 
			'date' => 'string',	// 
			'size' => 'integer',	// 
			'version' => 'double',	// 
			'icon' => 'string',	// 
			'category' => 'integer',	// 
			'checkout' => 'string',	// 
			'co_reason' => 'string',	// 
			'version_id' => 'integer',	// 
		);
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->addPrimaryKey('id', $this->tableName(), 'id')
		)->execute();
	}
}