<?php

class ProjectsController extends WebBaseController
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
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Projects;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model, 'projects-form');

		if(isset($_POST['Projects']))
		{
			$model->attributes=$_POST['Projects'];
			if($model->save()){
				foreach ($model->contacts as $ct){
					$m = new ProjectContact();
					$m->pid = $model->getPrimaryKey();
					$m->cid = $ct;
					$m->save();
				}
				foreach ($model->departments as $ct){
					$m = new ProjectDepartment();
					$m->pid = $model->getPrimaryKey();
					$m->did = $ct;
					$m->save();
				}
				$this->redirect(array('view','id'=>$model->id));
			}
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
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model, 'projects-form');

		if(isset($_POST['Projects']))
		{
			$model->attributes=$_POST['Projects'];

			if($model->save()){
				foreach ($model->contacts as $ct){
					$m = new ProjectContact();
					$m->pid = $model->getPrimaryKey();
					$m->cid = $ct;
					$m->save();
				}
				foreach ($model->departments as $ct){
					$m = new ProjectDepartment();
					$m->pid = $model->getPrimaryKey();
					$m->did = $ct;
					$m->save();
				}

				$this->redirect(array('view','id'=>$model->id));
			}
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
		$this->loadModel()->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Projects');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Projects('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Projects']))
			$model->attributes=$_GET['Projects'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
