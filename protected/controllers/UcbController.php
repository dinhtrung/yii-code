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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Ucb;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ucb']))
		{
			$model->attributes=$_POST['Ucb'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->data_timestamp));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ucb']))
		{
			$model->attributes=$_POST['Ucb'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->data_timestamp));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = Ucb::getModel();
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=Ucb::getModel(Yii::app()->request->getParam('suffix'));
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ucb']))
			$model->attributes=$_GET['Ucb'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionBrowse()
	{
		$model=new Ucb('search');
		$model->tableSuffix = Yii::app()->request->getParam('suffix');
		$model->refreshMetaData();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ucb']))
			$model->attributes=$_GET['Ucb'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionDevel(){
		$this->render('devel');
	}
	
	public function actionTable(){
		$table = Yii::app()->request->getParam('table');
		$model = Anonymous::getModel($table);
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[$model->getClassName()]))
			$model->attributes=$_GET[$model->getClassName()];
		
		$this->render('grid',array(
				'model'=>$model,
		));
	}
}
