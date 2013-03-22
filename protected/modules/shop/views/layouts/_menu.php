<?php
$this->mainMenu['shop'] = array(
	'label' => Yii::t('shop', 'shop'),
	'url'	=>	array('/shop'),
	'visible'	=>	Yii::app()->user->checkAccess('Shop.Default.Index'),
	'items'	=>	array(
			'category'	=>	array(
					'label' => Yii::t('shop', 'Category'),
					'url'	=>	array('/shop/category'),
					'visible'	=>	Yii::app()->user->checkAccess('Shop.Category.Index'),
			),
			'tax'	=>	array(
					'label' => Yii::t('shop', 'Tax'),
					'url'	=>	array('/shop/tax'),
					'visible'	=>	Yii::app()->user->checkAccess('Shop.Tax.Index'),
			)
	)
);