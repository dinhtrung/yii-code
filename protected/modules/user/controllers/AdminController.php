<?php

class AdminController extends WebBaseController
{
	public $defaultAction = 'admin';

	/**
	 * Manages all models.
	 */
	public function actions()
	{
		return array(
			'view'		=>	array('class' => 'ext.actions.ViewAction', 'modelClass' => 'User'),
			'admin'		=>	array('class' => 'ext.actions.AdminAction', 'modelClass' => 'User'),
		);
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
		$this->performAjaxValidation($model, 'user-form');
		Rights::getAuthorizer()->attachUserBehavior($model);
		/*
		// Get assigned Items for current user
		$assignedItems = Rights::getAuthorizer()->getAuthItems(CAuthItem::TYPE_ROLE, $model->getId());
		$model->role = array_keys($assignedItems);
		*/
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
			$model->createtime=time();
			$model->updatetime=time();
			if($model->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					// Update and redirect
					Rights::getAuthorizer()->authManager->assign($model->role, $model->getId());
					$item = Rights::getAuthorizer()->authManager->getAuthItem($model->role);
					$item = Rights::getAuthorizer()->attachAuthItemBehavior($item);
					$this->redirect(Yii::app()->getUser()->getReturnUrl());
				}
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel('User');
		$this->performAjaxValidation($model, 'user-form');
		foreach ($model->role as $r)
			Rights::getAuthorizer()->authManager->revoke($r, $model->getId());
		if(isset($_POST['User']))
		{
			$oldPass = $model->password;
			$model->attributes=$_POST['User'];
			if($model->validate()) {
				if (! empty($model->password) AND (Yii::app()->controller->module->encrypting($model->password)!=($oldPass))) {
					$model->password=Yii::app()->controller->module->encrypting($model->password);
					$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
				} else { $model->password = $oldPass; }
				$model->save();
				foreach ($model->role as $r)
					Rights::getAuthorizer()->authManager->assign($r, $model->getPrimaryKey());
				$this->redirect(Yii::app()->getUser()->getReturnUrl());
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel('User');
			foreach ($model->role as $role)
				Rights::getAuthorizer()->authManager->revoke($role, $model->getPrimaryKey());
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('/user/admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}