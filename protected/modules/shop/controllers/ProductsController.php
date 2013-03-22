<?php

class ProductsController extends WebBaseController
{

	public function actionCreate()
	{
		$model=new Products;

		 $this->performAjaxValidation($model);

		if(isset($_POST['Products']))
		{
			$model->attributes=$_POST['Products'];
			if(isset($_POST['Specifications']))
				$model->setSpecifications($_POST['Specifications']);


			if($model->save())
				$this->redirect(array('shop/admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id, $return = null)
	{
		$model=$this->loadModel();

		$this->performAjaxValidation($model);

		if(isset($_POST['Products']))
		{
			$model->attributes=$_POST['Products'];
			if(isset($_POST['Specifications']))
				$model->setSpecifications($_POST['Specifications']);
			if(isset($_POST['Variations']))
				$model->setVariations($_POST['Variations']);

			if($model->save())
				if($return == 'product')
					$this->redirect(array('products/update', 'id' => $model->product_id));
				else
					$this->redirect(array('products/admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
		public function actions(){
			return array(
					'index'	=>	'ext.actions.BrowseAction',
					'admin'	=>	'ext.actions.AdminAction',
					'delete'	=>	'ext.actions.DeleteAction',
					'view'	=>	'ext.actions.ViewAction',
			);
		}
}
