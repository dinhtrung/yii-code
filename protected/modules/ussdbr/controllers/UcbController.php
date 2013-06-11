<?php

class UcbController extends WebBaseController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout = '//layouts/column1';
		$model=Ucb::getModel(Yii::app()->request->getParam('suffix'));
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ucb']))
			$model->attributes=$_GET['Ucb'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
