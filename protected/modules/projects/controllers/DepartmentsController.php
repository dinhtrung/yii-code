<?php

class DepartmentsController extends WebBaseController
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
		$model=new Departments;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model, 'departments-form');

		if(isset($_POST['Departments']))
		{
			$model->attributes=$_POST['Departments'];
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
		// $this->performAjaxValidation($model, 'departments-form');

		if(isset($_POST['Departments']))
		{
			$model->attributes=$_POST['Departments'];
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
		$dataProvider=new CActiveDataProvider('Departments');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Departments('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Departments']))
			$model->attributes=$_GET['Departments'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
