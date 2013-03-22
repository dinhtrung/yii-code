<?php

class CustomerController extends WebBaseController
{
	public function actionCreate()
	{
		if($model = Shop::getCustomer())
			$address = $model->address;
		else
			$model = new Customer;

		if(isset($_POST['Customer']))
		{
			$model->attributes = $_POST['Customer'];
				if(isset($_POST['Address'])) {
					$address = new Address;
					$address->attributes = $_POST['Address'];
					if($address->save())
						$model->address_id = $address->id;
				}
				if(!Yii::app()->user->isGuest)
					$model->user_id = Yii::app()->user->id;

				if($model->save()) {
					Yii::app()->user->setState('customer_id', $model->customer_id);
					$this->redirect(
							array(
								'//shop/order/create', 'customer'=>$model->customer_id));
					}
		}

		$this->render('create',array(
			'customer'=>$model,
			'address'=>isset($address) ? $address : new Address,
		));
	}

	public function actionUpdate($order = null)
	{
		if(Yii::app()->user->isGuest) {
			$id = Yii::app()->user->getState('customer_id');
			$model = Customer::model()->findByPk($id);
		}
		else
			$model = Customer::model()->find('user_id = :uid', array(
				':uid' => Yii::app()->user->id));

		if(isset($_POST['Customer']))
		{
			$model->attributes=$_POST['Customer'];
			if(isset($_POST['Address'])) {
				$address = $model->address;
				$address->attributes = $_POST['Address'];
				if($address->save())
					$model->address_id = $address->id;
			}
			if($model->save()) {
				if($order !== null)
					$this->redirect(
							array(
								'//shop/order/create', 'customer'=>$model->customer_id));
				else
					$this->redirect(array('view','id'=>$model->customer_id));
			}
		}
		$address = $model->address;
		$deliveryAddress = $model->deliveryAddress;
		$billingAddress = $model->billingAddress;

		$this->render('update',array(
			'customer'=>$model,
			'address'=>isset($address) ? $address : new Address,
			'deliveryAddress'=>isset($deliveryAddress) ? $deliveryAddress : new DeliveryAddress,
			'billingAddress'=>isset($billingAddress) ? $billingAddress : new BillingAddress,

		));
	}

	public function actions(){
		return array(
				'index'	=>	'ext.actions.IndexAction',
				'admin'	=>	'ext.actions.AdminAction',
				'delete'	=>	'ext.actions.DeleteAction',
				'view'	=>	'ext.actions.ViewAction',
		);
	}

}
