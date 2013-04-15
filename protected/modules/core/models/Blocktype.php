<?php

class Blocktype extends BaseActiveRecord
{
	public function connectionId(){
		return Yii::app()->hasComponent('coreDb')?'coreDb':'db';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{blocktype}}';
	}
	/*
	 * CREATE TABLE IF NOT EXISTS `blocktype` (
		  `btid` varchar(40) unsigned NOT NULL AUTO_INCREMENT,
		  `title` varchar(100) DEFAULT NULL,
		  `description` text,
		  `component` varchar(255) DEFAULT NULL,
		  `callback` varchar(255) DEFAULT NULL,
		  `viewfile` varchar(255) DEFAULT NULL,
		  PRIMARY KEY (`btid`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8
	 */
	protected function createTable(){
		$columns = array(
				'btid'	=>	'string',
				'title'	=>	'string',
				'description'	=>	'text',
				'component'	=>	'string',
				'callback'	=>	'string',
				'viewfile'	=>	'string',
		);
		try {
			$this->getDbConnection()->createCommand(
					Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
			$this->getDbConnection()->createCommand(
					Yii::app()->getDb()->getSchema()->addPrimaryKey('btid', $this->tableName(), 'btid')
			)->execute();
			$this->getDbConnection()->createCommand(
					Yii::app()->getDb()->getSchema()->createIndex('ccv', $this->tableName(), 'component,callback,viewfile')
			)->execute();

		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
		$this->refreshMetaData();

		try {
			$ref = new Block();
			$this->getDbConnection()->createCommand(
					Yii::app()->getDb()->getSchema()->addForeignKey('fk_blocktype_block', $this->tableName(), 'btid', $ref->tableName(), 'type')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
	}

	public function rules()
	{
		return array_merge(
				parent::rules(), array(
			array('btid', 'unique'),
			array('component', 'validComponent'),
			array('viewfile', 'validViewfile'),
		) );
	}

	function validComponent($attribute,$params) {
		if(!$this->hasErrors()){
			try {
				Yii::import($this->component);
			} catch (Exception $e) {
				$this->addError($attribute, Yii::t('core', "Component :comp does not valid.", array(':comp' => $this->component)));
			}
		}
	}
	function validViewfile($attribute,$params) {
		if(!$this->hasErrors()){
			if (! Yii::app()->getController()->getViewFile($this->viewfile)){
				$this->addError($attribute, Yii::t('core', "Viewfile :view does not valid.", array(':view' => $this->viewfile)));
			}
		}

	}

	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
			"blocks"	=>	Yii::t('core', "Blocks"),
		));
	}

	public function relations()
	{
		return array(
			"blocks"	=>	array(self::HAS_MANY, "Block", "type"),
		);
	}

	/**
	 * Sort blocktype by title by default
	 * @see CActiveRecord::defaultScope()
	 */
	public function defaultScope(){
		return array(
			'order'	=>	'title ASC',
		);
	}
	/**
	 * Return a list of options
	 */
	public static function listData(){
		return CHtml::listData(self::model()->findAll(), 'btid', 'title');
	}
	protected function afterSave(){
		$config = new BlocktypeConfig('insert', 'application.config.blocktypes');
		$config->setAttributes($this->getAttributes());
		$config->save();
		return parent::afterSave();
	}
}
