<?php
/*
 * Use this file to create models for this module
 */
class DefaultModel extends BaseActiveRecord
{
	public $tablename="";

	public function connectionId(){
		return Yii::app()->hasComponent('dpviewsDb')?'dpviewsDb':'db';
	}

	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{'.$this->tablename.'}}';
	}

	public function getClassName() {
		return $this->generateClassName($this->tablename);
	}

	public static function getModel($tablename) {
		$model = new DefaultModel(null);
		$model->tablename = $tablename;
		return DefaultModel::model($model); // Register the instance
	}


	protected function instantiate($attributes) {
		$model = new DefaultModel(null);
		$model->tablename = $this->tablename;
		return $model;
	}
}