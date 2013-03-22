<?php

/**
 * This is the model class for table "shop_address".
 *
 * The followings are the available columns in table 'shop_address':
 * @property integer $id
 * @property string $street
 * @property string $zipcode
 * @property string $city
 * @property string $country
 */
class Address extends BaseActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function isEmpty($vars) {
		return
			$vars['street'] == ''
			|| $vars['zipcode'] == ''
			|| $vars['city'] == ''
			|| $vars['country'] == '';
	}

	public function renderAddress() {
		echo $this->firstname . ' ' . $this->lastname . '<br />';
		echo $this->street . '<br />';
		echo $this->zipcode . ' ' . $this->city . '<br />';
		echo $this->country;
	}

	/*
	 * Display in CGridView
	*/
	public function __toString(){
		return Yii::t('shop', "firstname lastname, street - city, country (zipcode)", $this->getAttributes());
	}

	public function tableName()
	{
		return '{{shop_address}}';
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

	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'firstname'	=>	'string',
				'lastname'	=>	'string',
				'street'	=>	'string',
				'zipcode'	=>	'string',
				'city'	=>	'string',
				'country'	=>	'string',
		);
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
	}

}
