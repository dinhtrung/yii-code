<?php

class ImageController extends WebBaseController
{
	public function actions(){
		return array(
				'index'	=>	'ext.actions.BrowseAction',
				'update'	=>	'ext.actions.UpdateAction',
				'delete'	=>	'ext.actions.DeleteAction',
				'view'	=>	'ext.actions.ViewAction',
		);
	}

	public function actionCreate()
	{
		$model=new Image;

		if(isset($_POST['Image']))
		{
			$model->attributes=$_POST['Image'];
			$model->filename = CUploadedFile::getInstance($model, 'filename');
			if($model->save()) {
				$folder = Yii::app()->controller->module->productImagesFolder;
				$model->filename->saveAs($folder . '/' . $model->filename);
				$this->redirect(array('//shop/products/admin'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	public function actionAdmin()
	{
		$product = Products::model()->findByPk($_GET['product_id']);

		$images = $product->images;

		$this->render('admin',array( 'images'=>$images, 'product' => $product));
	}

}
