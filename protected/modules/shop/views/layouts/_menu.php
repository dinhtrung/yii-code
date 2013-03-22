<?php
$this->mainMenu['shop'] = array(
	'label' => Yii::t('shop', 'shop'),
	'url'	=>	array('/shop'),
	'visible'	=>	Yii::app()->user->checkAccess('Shop.Default.Index'),
	'items'	=>	array(

			'admin'	=>	array(
					'label' => Yii::t('shop', 'Administration'),
					'items'	=>	array(
						'customer'	=>	array(
								'label' => Yii::t('shop', 'Customers'),
								'url'	=>	array('/shop/customer/admin'),
								'visible'	=>	Yii::app()->user->checkAccess('Shop.Customer.Admin'),
						),
						'products'	=>	array(
								'label' => Yii::t('shop', 'Products'),
								'url'	=>	array('/shop/products/admin'),
								'visible'	=>	Yii::app()->user->checkAccess('Shop.Products.Admin'),
						),
						'productSpecification'	=>	array(
								'label' => Yii::t('shop', 'Product Specification'),
								'url'	=>	array('/shop/productSpecification/admin'),
								'visible'	=>	Yii::app()->user->checkAccess('Shop.ProductSpecification.Admin'),
						),
						'category'	=>	array(
								'label' => Yii::t('shop', 'Category'),
								'url'	=>	array('/shop/category'),
								'visible'	=>	Yii::app()->user->checkAccess('Shop.Category.Index'),
						),
						'image'	=>	array(
								'label' => Yii::t('shop', 'Image'),
								'url'	=>	array('/shop/image/admin'),
								'visible'	=>	Yii::app()->user->checkAccess('Shop.Image.Admin'),
						),
						'paymentmethod'	=>	array(
								'label' => Yii::t('shop', 'Payment Methods'),
								'url'	=>	array('/shop/paymentmethod'),
								'visible'	=>	Yii::app()->user->checkAccess('Shop.Paymentmethod.Index'),
						),
						'shippingMethod'	=>	array(
								'label' => Yii::t('shop', 'Shipping Methods'),
								'url'	=>	array('/shop/shippingMethod'),
								'visible'	=>	Yii::app()->user->checkAccess('Shop.shippingMethod.Index'),
						),
						'tax'	=>	array(
								'label' => Yii::t('shop', 'Tax'),
								'url'	=>	array('/shop/tax'),
								'visible'	=>	Yii::app()->user->checkAccess('Shop.Tax.Index'),
						),
					)
			),
	)
);