<?php

class TaskLogController extends WebBaseController
{

	public function allowedActions(){
		return '';
	}

	/**
	 * Available actions
	 */
	public function actions(){
		return array(
			'index' => 'ext.actions.BrowseAction',
			'view' 	=> 'ext.actions.ViewAction',
			'create' => 'ext.actions.CreateAction',
			'update' => 'ext.actions.UpdateAction',
			'delete' => 'ext.actions.DeleteAction',
			'settings' => 'ext.actions.SettingsAction',
			'duplicate' => 'ext.actions.DuplicateAction',
		);
	}

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
		$model=new TaskLog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model, 'tasklog-form');

		if(isset($_POST['TaskLog']))
		{
			$model->attributes=$_POST['TaskLog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		// $this->performAjaxValidation($model, 'tasklog-form');

		if(isset($_POST['TaskLog']))
		{
			$model->attributes=$_POST['TaskLog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('TaskLog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TaskLog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TaskLog']))
			$model->attributes=$_GET['TaskLog'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
