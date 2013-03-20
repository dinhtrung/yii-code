<?php

class Blocktype extends BaseActiveRecord
{
	// Add your model-specific methods here. This file will not be overriden by gtc except you force it.
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function init()
	{
		return parent::init();
	}

	public function tableName()
	{
		return '{{blocktype}}';
	}

	public function rules()
	{
		return array(
			array('component', 'validComponent'),
			array('viewfile', 'validViewfile'),
			array('title, viewfile', 'required'),
			array('title, description, component, callback, viewfile', 'default', 'setOnEmpty' => true, 'value' => null),
			array('title', 'length', 'max'=>100),
			array('component, callback, viewfile', 'length', 'max'=>255),
			array('description', 'safe'),
			array('btid, title, description, component, callback, viewfile', 'safe', 'on'=>'search'),
		);
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



	public function __toString() {
		return (string) $this->title;

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
}
