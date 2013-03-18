<?php

class NodeFileController extends WebBaseController
{

	public function allowedActions()
	{
		return '';
	}

	public function init(){
		parent::init();
	}

	function actions(){
		return array(
			'create'	=>	'ext.actions.CreateAction',
			'update'	=>	'ext.actions.UpdateAction',
			'delete'	=>	'ext.actions.DeleteAction',
		);
	}

	/*
	* View detail information for an item
	*/
	public function actionView()
	{
		$this->render('view',array(
			'model' => $this->loadModel(),
		));
	}

	public function actionUpdate()
	{
		$model = $this->loadModel();
		$this->performAjaxValidation($model, 'nodefile-form');

		if(!empty($_POST['Nodefile']))
		{
			$model->setAttributes($_POST['Nodefile']);
			$model->setTags($model->tags);
			if($model->save()) {

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
					'model'=>$model,
					));
	}
	public function actionUpload()
	{
		Yii::import('ext.multimodelform.MultiModelForm');
		$model = $this->loadModel();
		$item = new File();
		$valid = array();
		if(!empty($_POST['NodeFile'])) {
			$model->setAttributes($_POST['NodeFile']);
			$masterValues = array(
				'pkey' 		=> $model->id,
				'entity' 	=> trim($model->tableName(), '{}'),
				'path'		=> Yii::getPathOfAlias("webroot") . DIRECTORY_SEPARATOR . Yii::app()->setting->get("File", "path", "files"),
				'version'	=> 1,
			);
			if	(MultiModelForm::save($item,$valid,$deleted,$masterValues)){
			}
		}
		$this->render('upload',array( 'model'=>$model, 'item' => $item, 'valid' => $valid));
	}

	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel()->delete();

			if(empty($_GET['ajax']))
			{
				if(!empty($_POST['returnUrl']))
					$this->redirect($_POST['returnUrl']);
				else
					$this->redirect(array('admin'));
			}
		}
		else
			throw new CHttpException(400,
					Yii::t('core', 'Invalid request. Please do not repeat this request again.'));
	}

	public function actionIndex()
	{
		$model = NodeFile::model();
		if (isset($_GET["tag"])) {
			$model->taggedWith($_GET["tag"]);
		}
		$dataProvider=new CActiveDataProvider($model);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* List available items
	**/
	public function actionAdmin()
	{
		$model=new NodeFile('search');
		if (intval(Yii::app()->request->getParam('clearFilters'))==1) {
		    EButtonColumnWithClearFilters::clearFilters($this,$model);
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
