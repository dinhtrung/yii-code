<?php

/**
 * This is the model class for table "shop_shipping_method".
 *
 * The followings are the available columns in table 'shop_shipping_method':
 * @property string $id
 * @property string $title
 * @property integer $tax_id
 * @property double $price
 */
class ShippingMethod extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ShippingMethod the static model class
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
		return 'shop_shipping_method';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, tax_id, price', 'required'),
			array('tax_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('description', 'safe'),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, tax_id, price', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/*
	 * create Table:  category_id 	parent_id 	title 	description 	language
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'title'		=>	'string',
				'description'	=>	'text',
				'tax_id'	=>	'int',
				'price'		=>	'float',
		);
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('tax', $this->tableName(), 'tax_id')
		)->execute();
	}
}
