<?php

class Order extends BaseActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return Yii::app()->controller->module->orderTable;
	}

	public function rules()
	{
		return array(
			array('customer_id, ordering_date, delivery_address_id, billing_address_id, payment_method', 'required'),
			array('customer_id, ordering_done, ordering_confirmed', 'numerical', 'integerOnly'=>true),
			array('order_id, customer_id, ordering_date, ordering_done, ordering_confirmed, comment', 'safe'),
		);
	}

	public function relations()
	{
		return array(
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'products' => array(self::HAS_MANY, 'OrderPosition', 'order_id'),
			'address' => array(self::BELONGS_TO, 'Address', 'address_id'),
			'billingAddress' => array(self::BELONGS_TO, 'BillingAddress', 'billing_address_id'),
			'deliveryAddress' => array(self::BELONGS_TO, 'DeliveryAddress', 'delivery_address_id'),
			'paymentMethod' => array(self::BELONGS_TO, 'PaymentMethod', 'payment_method'),
			'shippingMethod' => array(self::BELONGS_TO, 'ShippingMethod', 'shipping_method'),

		);
	}


	public function getTotalPrice() {
		$price = 0;
		if($this->products)
			foreach($this->products as $position)
				$price += $position->getPrice();

		if($this->shippingMethod)
			$price += $this->shippingMethod->price;

		return $price;
	}

/*
	 * create Table:  category_id 	parent_id 	title 	description 	language
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'customer_id'	=>	'int',
				'billing_address_id'	=>	'int',
				'delivery_address_id'	=>	'int',
				'ordering_date'	=>	'datetime',
				'ordering_done'	=>	'boolean',
				'ordering_confirmed'	=>	'boolean',
				'payment_method'	=>	'int',
				'shipping_method'	=>	'int',
				'comment'	=>	'text',
		);
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('customer', $this->tableName(), 'customer_id')
		)->execute();
	}
}
