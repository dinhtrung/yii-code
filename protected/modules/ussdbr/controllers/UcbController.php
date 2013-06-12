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
		$suffix = NULL;
		if (isset($_GET['Ucb']['data_timestamp']))
			$suffix = substr(str_replace('-', '', $_GET['Ucb']['data_timestamp']), 0, 6);
		$model = Ucb::getModel($suffix);
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ucb'])){
			$model->setAttributes($_GET['Ucb']);
			CVarDumper::dump($_GET['Ucb'], 10, TRUE);
			CVarDumper::dump($suffix, 10, TRUE);
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
