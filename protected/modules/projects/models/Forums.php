<?php
/**
 * This is the model class for table "forums".
 *
 * The followings are the available columns in table 'forums':
 * @property integer $id
 * @property integer $project
 * @property integer $status
 * @property integer $owner
 * @property string $name
 * @property string $last_id
 * @property integer $message_count
 * @property string $description
 * @property integer $moderated
 * @property integer $createtime
 * @property integer $updatetime
 */
class Forums extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Forums the static model class
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
		return '{{forums}}';
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
			'project' => 'integer',	// 
			'status' => 'integer',	// 
			'owner' => 'integer',	// 
			'name' => 'string',	// 
			'last_id' => 'string',	// 
			'message_count' => 'integer',	// 
			'description' => 'string',	// 
			'moderated' => 'integer',	// 
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