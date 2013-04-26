<?php
/**
 * This is the model class for table "forum_messages".
 *
 * The followings are the available columns in table 'forum_messages':
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property integer $forum
 * @property string $title
 * @property string $body
 * @property integer $createtime
 * @property integer $updatetime
 * @property integer $author
 * @property integer $editor
 * @property integer $published
 */
class ForumMessages extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ForumMessages the static model class
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
		return '{{forum_messages}}';
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
			'forum' => 'integer',	// 
			'title' => 'string',	// 
			'body' => 'string',	// 
			'createtime' => 'integer',	// 
			'updatetime' => 'integer',	// 
			'author' => 'integer',	// 
			'editor' => 'integer',	// 
			'published' => 'integer',	// 
		);
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->addPrimaryKey('id', $this->tableName(), 'id')
		)->execute();
	}
}