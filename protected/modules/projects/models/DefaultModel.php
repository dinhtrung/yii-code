<?php
/*
 * Use this file to create models for this module
 */
class DefaultModel extends BaseActiveRecord
{
	public function connectionId(){
		return Yii::app()->hasComponent('projectsDb')?'projectsDb':'db';
	}

	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{projects}}';
	}
}