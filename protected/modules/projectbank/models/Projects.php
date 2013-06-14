<?php
/*
 * Use this file to create models for this module
 */
class Projects extends BaseActiveRecord
{
	public function connectionId(){
		return Yii::app()->hasComponent('projectbankDb')?'projectbankDb':'db';
	}

	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{projects}}';
	}
	
	protected function createTable(){
		$columns = array (
			'id'	=>	'pk',
		  	'title' => 'string',
		  	'description' => 'text',
			'createtime'	=>	'int',
			'updatetime'	=>	'int',
		);
		try {
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
		$this->refreshMetaData();
	}
	
	protected function beforeValidate() {
		$this->updatetime = time();
		if ($this->isNewRecord)
			$this->createtime = time();
		return parent::beforeValidate();
	}
	
	public static function getOptions($required = TRUE, $condition = NULL){
		if ($required)
			return CHtml::listData(self::model()->findAll($condition), 'id', 'title');
		else
			return array('' => Yii::t('projectbank', '-- Select Project --')) + self::getOptions(TRUE);
	}
	
	public function defaultScope(){
		return array(
				'order' => 'updatetime DESC',
		);
	}
}