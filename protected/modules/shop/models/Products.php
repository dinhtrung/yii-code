<?php

class Products extends BaseActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return Shop::module()->productsTable;
	}

	public function relations()
	{
		return array(
			'variations' => array(self::HAS_MANY, 'ProductVariation', 'product_id', 'order' => 'position'),
			'orders' => array(self::MANY_MANY, 'Order', 'ShopProductOrder(order_id, product_id)'),
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'tax' => array(self::BELONGS_TO, 'Tax', 'tax_id'),
			'images' => array(self::HAS_MANY, 'Image', 'product_id'),
			'shopping_carts' => array(self::HAS_MANY, 'ShoppingCart', 'product_id'),
		);
	}

	public function getSpecification($spec) {
		$specs = json_decode($this->specifications, true);

		if(isset($specs[$spec]))
			return $specs[$spec];

		return false;
	}

	public function getImage($image = 0, $thumb = false) {
		if(isset($this->images[$image]))
			return Yii::app()->controller->renderPartial('/image/view', array(
				'model' => $this->images[$image],
				'thumb' => $thumb), true);
	}

	public function getSpecifications() {
		$specs = json_decode($this->specifications, true);
		return $specs === null ? array() : $specs;
	}

	public function setSpecification($spec, $value) {
		$specs = json_decode($this->specifications, true);

		$specs[$spec] = $value;

		return $this->specifications = json_encode($specs);
	}

	public function setSpecifications($specs) {
		foreach($specs as $k => $v)
			$this->setSpecification($k, $v);
	}

	public function setVariations($variations) {
		$db = Yii::app()->db;
		$db->createCommand()->delete('shop_product_variation',
				'product_id = :product_id', array(
					':product_id' => $this->product_id));

		foreach($variations as $key => $value) {
			if($value['specification_id']
					&& isset($value['title'])
					&& $value['title'] != '') {

				if(isset($value['sign']) && $value['sign'] == '-')
					$value['price_adjustion'] -= 2 * $value['price_adjustion'];


				$db->createCommand()->insert('shop_product_variation', array(
							'product_id' => $this->product_id,
							'specification_id' => $value['specification_id'],
							'position' => @$value['position'] ?: 0,
							'title' => $value['title'],
							'price_adjustion' => @$value['price_adjustion'] ?: 0,
							));
			}
		}
	}

		public function getVariations() {
		$variations = array();
		foreach($this->variations as $variation) {
			$variations[$variation->specification_id][] = $variation;
		}

		return $variations;
	}


	public function getTaxRate($variations = null, $amount = 1) {
		if($this->tax) {
			$taxrate = $this->tax->percent;
			$price = (float) $this->price;
			if($variations)
				foreach($variations as $key => $variation) {
					$price += @ProductVariation::model()->findByPk($variation[0])->price_adjustion;
				}


			(float) $price *= $amount;

			(float) $tax = $price * ($taxrate / 100);

			return $tax;
		}
	}
	public function getPrice($variations = null, $amount = 1) {
		$price = (float) $this->price;
		if($variations)
			foreach($variations as $key => $variation) {
				$price += @ProductVariation::model()->findByPk($variation[0])->price_adjustion;
			}


		(float) $price *= $amount;

		return $price;
	}

	/*
	 *   id 	category_id 	tax_id 	title 	description 	price 	language 	specifications
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'title'		=>	'string',
				'description'		=>	'text',
				'price'		=>	'float',
				'category_id'	=>	'int',
				'tax_id'	=>	'int',
				'language'	=>	'string',
				'specifications'	=>	'text',
		);
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('title', $this->tableName(), 'title')
		)->execute();
		//@TODO: Add foreign key for me...
	}
}
