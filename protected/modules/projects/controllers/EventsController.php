<?php

class EventsController extends WebBaseController
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
		$model=new Events;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model, 'Events-form');

		if(! Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST['Events']))
		{
			$model->setAttributes($_POST['Events']);
			if (empty($_POST['Events']['root'])){
				$model->saveNode();
			} elseif  (! is_null($root = Events::model()->findByPk($_POST['Events']['root']))){
				$model->appendTo($root);
			} else throw new CHttpException(500,
					Yii::t('app', "Invalid root node ID: %d", array('%d' => $_POST['Events']['root'])));
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
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model, 'Events-form');

		if(isset($_POST['Events']))
		{
			$model->setAttributes($_POST['Events']);
			if (empty($_POST['Events']['root'])){
				if (! $model->isRoot()) $model->moveAsRoot();
			} elseif  (! is_null($root = Events::model()->findByPk($_POST['Events']['root']))){
				if ($root->getPrimaryKey() != $model->getPrimaryKey()) $model->moveAsLast($root);
			} else throw new CHttpException(500,
					Yii::t('app', "Invalid root node ID: %d", array('%d' => $_POST['Events']['root'])));
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
		$dataProvider=new CActiveDataProvider('Events');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Events('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Events']))
			$model->attributes=$_GET['Events'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}
}
