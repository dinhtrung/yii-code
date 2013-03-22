<?php

/**
 * This is the model class a order position.
 *
 * The followings are the available columns in table 'shop_order_position':
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $amount
 * @property string $specifications
 */
class OrderPosition extends BaseActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'shop_order_position';
	}

	public function rules()
	{
		return array(
			array('order_id, product_id, amount, specifications', 'required'),
			array('order_id, product_id, amount', 'numerical', 'integerOnly'=>true),
			array('id, order_id, product_id, amount, specifications', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
			'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
		);
	}

	public function getSpecifications() {
		$specs = json_decode($this->specifications, true);
		$specifications = array();
		if($specs)
			foreach($specs as $key => $specification) {
				$specifications[$key] = $specification;
			}

		return $specifications;
	}

	public function renderSpecifications() {
		$string = '<table>';
		foreach($this->getSpecifications() as $key =>$specification) {
			if($model = ProductSpecification::model()->findByPk($key))
				if($model->is_user_input)
					$value = $specification[0];
				else
					$value = @ProductVariation::model()->findByPk($specification[0])->title;
			$string .= sprintf('<tr><td>%s</td><td>%s</td></tr>',
				$model->title,
				$value
				);
		}
		$string .= '</table>';
		return $string;
	}

	public function listSpecifications() {
		if(!$specs = $this->getSpecifications())
			return '';

		$str = '(';
		foreach($specs as $key => $specification) {
			if($model = ProductSpecification::model()->findByPk($key))
				if($model->is_user_input)
					$value = $specification[0];
				else
					$value = @ProductVariation::model()->findByPk($specification[0])->title;

		$str .= $model->title. ': '.$value . ', ';
		}

		$str = substr($str, 0, -2);
		$str .= ')';

		return $str;
	}

	public function getPrice() {
		$price = $this->product->price;

		if($this->specifications)
			foreach($this->getSpecifications() as $key => $spec)
				$price += @ProductVariation::model()->findByPk(@$spec[0])->price_adjustion;

		return $this->amount * $price;
	}


	/*
	 * create Table:  category_id 	parent_id 	title 	description 	language
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'order_id'	=>	'int',
				'product_id'	=>	'int',
				'amount'	=>	'int',
				'specifications'	=>	'text',
		);
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('order', $this->tableName(), 'order_id')
		)->execute();
	}
}
