<?php

class Image extends BaseActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return Yii::app()->controller->module->imageTable;
	}

	public function rules()
	{
		return array(
			array('title, filename, product_id', 'required'),
			array('id, product_id', 'numerical', 'integerOnly'=>true),
			array('title, filename', 'length', 'max'=>45),
			//array('filename' => 'file', 'types' => 'png,gif,jpg,jpeg'),
			array('id, title, filename, product_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'Product' => array(self::BELONGS_TO, 'Products', 'product_id'),
		);
	}

/*
	 * create Table:  category_id 	parent_id 	title 	description 	language
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'product_id'	=>	'int',
				'title'		=>	'string',
				'filename'	=>	'string',
		);
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('product', $this->tableName(), 'product_id')
		)->execute();
	}
}
