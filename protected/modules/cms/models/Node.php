<?php

/**
 * This is the model base class for the table "node".
 *
 * Columns in table "node" available as properties of the model:
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $body
 * @property integer $createtime
 * @property integer $updatetime
 * @property integer $uid
 * @property integer $cid
 * @property string $tags
 *
 * There are no model relations.
 */
Yii::import('ext.yiiext.behaviors.model.taggable.*');
class Node extends BaseActiveRecord{

	public $tags;
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
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{node}}';
	}
	/**
	* Relation to other models
	*/
	public function relations()
	{
		return array(
			'category' 	=> array(self::BELONGS_TO, 'Category', 'cid'),
			'user'		=> array(self::BELONGS_TO, 'User', 'uid'),
		);
	}

	public function rules(){
		return array_merge(parent::rules(), array(
			array('user,category,tags', 'safe', 'on' => 'insert,update'),
		));
	}
	/**
	* Attribute labels
	*/
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
				'user'	=>	Yii::t('cms', 'User'),
				'category'	=>	Yii::t('cms', 'Category'),
		));
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'createtime DESC',
		);
	}
	/**
	* Run before validate()
	*/
	protected function beforeValidate() {
		if (empty($this->alias)) $this->alias = TextHelper::utf2ascii($this->title, TRUE, '-');
		return parent::beforeValidate();
	}
	/**
	* Run before save()
	*/
	protected function beforeSave() {
		if ($this->getIsNewRecord()) {
			$this->uid = Yii::app()->getUser()->getId();
		}
		if (! $this->description) $this->description = TextHelper::word_limiter(strip_tags($this->body),255);
		$this->Taggable->setTags($this->tags);
		return parent::beforeSave();
	}
	/**
	* Run before delete()
	*/
	protected function beforeDelete() {
		$this->tags = array();
		$this->Taggable->removeAllTags();
		$this->save();
		return parent::beforeDelete();
	}

	/**
	 * Render the status options
	 */
	const STATUS_PUBLISHED = 1;
	const STATUS_ARCHIVED = 2;
	const STATUS_DRAFT = 0;
	public static function statusOption($param = NULL) {
		$options = array(
			self::STATUS_ARCHIVED	=>	Yii::t('cms', "Archived"),
			self::STATUS_DRAFT		=>	Yii::t('cms', "Draft"),
			self::STATUS_PUBLISHED	=>	Yii::t('cms', "Published"),
		);
		if (is_null($param)) return $options;
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}
	/**
	* Configure additional behaviors
	*/
	public function behaviors()
	{
		return array_merge(parent::behaviors(),
			array(
				'Taggable' => array(
					'class' => 'ext.yiiext.behaviors.model.taggable.EARTaggableBehavior',
					'tagTable' => '{{tags}}',
					'tagModel' => 'Tags',
					'tagBindingTable' => '{{node_tag}}',
					'modelTableFk' => 'nid',
					'tagTablePk' => 'id',
					'tagTableName' => 'name',
					'tagTableCount' => 'frequency',
					'tagBindingTableTagId' => 'tid',
					'cacheID' => 'cache',
					'createTagsAutomatically' => true,
					'scope' => array(),
					'insertValues' => array(),
				),
			)

		);
	}

	/**
	 * Create the table if needed
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'title'	=>	'string',
				'alias'	=>	'string',
				'description'	=>	'text',
				'body'	=>	'text',
				'createtime'	=>	'int',
				'updatetime'	=>	'int',
				'status'	=>	'boolean',
				'uid'	=>	'int',
				'cid'	=>	'int',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
	}

}
