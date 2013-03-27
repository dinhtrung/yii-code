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
		return array_merge(parent::attributeLabels(), array(
				'user'	=>	Yii::t('core', 'User'),
				'category'	=>	Yii::t('core', 'Category'),
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
			self::STATUS_ARCHIVED	=>	Yii::t('core', "Archived"),
			self::STATUS_DRAFT		=>	Yii::t('core', "Draft"),
			self::STATUS_PUBLISHED	=>	Yii::t('core', "Published"),
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
