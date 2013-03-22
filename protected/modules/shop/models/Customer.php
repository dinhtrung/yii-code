<?php

class Customer extends BaseActiveRecord
{
	public $terms_accepted = null;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return Yii::app()->getModule('shop')->customerTable;
	}

	public function rules()
	{
		return array(
			array('email', 'required'),
			array('address_id, customer_id, user_id', 'numerical', 'integerOnly'=>true),
			array('email', 'CEmailValidator'),
			array('customer_id, user_id, email', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'Orders' => array(self::HAS_MANY, 'Order', 'customer_id'),
			'ShoppingCarts' => array(self::HAS_MANY, 'ShoppingCart', 'customer_id'),
			'address' => array(self::BELONGS_TO, 'Address', 'address_id'),
			'billingAddress' => array(self::BELONGS_TO, 'BillingAddress', 'billing_address_id'),
			'deliveryAddress' => array(self::BELONGS_TO, 'DeliveryAddress', 'delivery_address_id'),
		);
	}

	/*
	 * create Table:  category_id 	parent_id 	title 	description 	language
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'email'		=>	'string',
				'user_id'	=>	'int',
				'address_id'	=>	'int',
				'delivery_address_id'	=>	'int',
				'billing_address_id'	=>	'int',
		);
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('user', $this->tableName(), 'user_id')
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('address', $this->tableName(), 'address_id')
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('delivery', $this->tableName(), 'delivery_address_id')
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('billing', $this->tableName(), 'billing_address_id')
		)->execute();
	}
}
