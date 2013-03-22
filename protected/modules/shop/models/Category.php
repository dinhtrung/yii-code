<?php

class Category extends BaseActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getChilds($id) {
		$data = array();

		foreach(Category::model()->findAll('parent_id = ' . $id) as $model) {
			$row['text'] = CHtml::link($model->title, array('category/view', 'id' => $model->category_id));
			$row['children'] = Category::getChilds($model->category_id);
			$data[] = $row;
		}
		return $data;
	}


	public function tableName()
	{
		return Yii::app()->getModule('shop')->categoryTable;
	}


	public static function getListed() {
		$subitems = array();
		if($this->childs) foreach($this->childs as $child) {
			$subitems[] = $child->getListed();
		}
		$returnarray = array('label' => $this->title, 'url' => array('Category/view', 'id' => $this->category_id));
		if($subitems != array()) $returnarray = array_merge($returnarray, array('items' => $subitems));
		return $returnarray;
	}

	public function relations()
	{
		return array(
			'Products' => array(self::HAS_MANY, 'Products', 'category_id'),
			'parent' => array(self::BELONGS_TO, 'Category', 'parent_id'),
			'childs' => array(self::HAS_MANY, 'Category', 'parent_id'),
		);
	}

	/*
	 * create Table:  category_id 	parent_id 	title 	description 	language
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'parent_id'	=>	'int',
				'title'		=>	'string',
				'description'	=>	'text',
				'language'		=>	'string',
		);
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('pid', $this->tableName(), 'parent_id')
		)->execute();
	}

}
