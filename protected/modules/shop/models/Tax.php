<?php

/**
 * This is the model class for table "shop_tax".
 *
 * The followings are the available columns in table 'shop_tax':
 * @property integer $id
 * @property string $title
 * @property integer $percent
 */
class Tax extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tax the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{shop_tax}}';
	}

	/*
	 * Display in CGridView
	 */
	public function __toString(){
		return $this->title;
	}


	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'title'	=>	'string',
				'percent'	=>	'int',
		);
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('title', $this->tableName(), 'time')
		)->execute();
	}
}