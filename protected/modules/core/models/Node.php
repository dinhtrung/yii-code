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
	* This magic method is used for setting a string value for the object. It will be used if the object is used as a string.
	* @return string representing the object
	*/
	public function __toString() {
		return (string) $this->title;

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{node}}';
	}
	/**
	* Define validation rules
	*/
	public function rules()
	{
		return array(
			'type' => array('type', 'default', 'on' => 'update, insert', 'setOnEmpty' => TRUE, 'value' => 'node'),
			array('type', 'unsafe', 'on' => 'update, insert'),
			array('alias', 'unique'),
			'alias' => array('alias', 'unsafe'),
			array('status', 'in', 'on' => 'insert, update', 'range' => array_keys(self::statusOption())),
			array('title', 'required', 'on' => 'insert, update'),
			array('body','safe'),
			array('createtime, updatetime, uid', 'unsafe', 'on' => 'insert, update'),
			array('cid', 'numerical', 'integerOnly'=>true),
			array('title, tags', 'length', 'max'=>255),
			array('title, body, createtime, updatetime, uid, cid, tags', 'safe', 'on'=>'search'),
		);
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
	/**
	* Attribute labels
	*/
	public function attributeLabels()
	{
		return array(
			'title' => Yii::t('node', 'Title'),
			'body' => Yii::t('node', 'Body'),
			'createtime' => Yii::t('node', 'Createtime'),
			'updatetime' => Yii::t('node', 'Updatetime'),
			'cid' => Yii::t('node', 'Category'),
			'tags' => Yii::t('node', 'Tags'),
		);
	}
	/**
	* Which attribute are safe for search
	*/
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('createtime', $this->createtime);
		$criteria->compare('updatetime', $this->updatetime);
		$criteria->compare('status', $this->status);
		$criteria->compare('cid', $this->cid);
		/* FIXME: MySQL Full text search
		 * $criteria->select = array(
		        "MATCH (title, body) AGAINST ('*{$_GET['q']}*'  IN BOOLEAN MODE) as relevance"
		);*/

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
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
	* Run after validate()
	*/
	protected function afterValidate() {
		return parent::afterValidate();
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
	* Run after save()
	*/
	protected function afterSave() {
		return parent::afterSave();
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
	* Run after delete()
	*/
	protected function afterDelete() {
		return parent::afterDelete();
	}

	/**
	 * Render the status options
	 */
	const STATUS_PUBLISHED = 1;
	const STATUS_ARCHIVED = 2;
	const STATUS_DRAFT = 0;
	public static function statusOption($param = NULL) {
		$options = array(
			self::STATUS_ARCHIVED	=>	Yii::t('node', "Archived"),
			self::STATUS_DRAFT		=>	Yii::t('app', "Draft"),
			self::STATUS_PUBLISHED	=>	Yii::t('app', "Published"),
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
		return array_merge(
			array(
				'Taggable' => array(
					'class' => 'ext.yiiext.behaviors.model.taggable.EARTaggableBehavior',
					'tagTable' => 'tags',
					'tagModel' => 'Tags',
					'tagBindingTable' => 'node_tag',
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
			),
			parent::behaviors()
		);
	}

}
