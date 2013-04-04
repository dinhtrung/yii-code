<?php
class DatafileController extends WebBaseController {
	public function allowedActions() {
		return;
	}

	public function init() {
		parent::init();
	}

	public function actionCreate() {
		$model = new Datafile;
		$file = CUploadedFile::getInstance($model, 'filepath');
		if (!empty($_POST['Datafile']) && !is_null($file)) {
			$model->setFileInstance($file);
			$model->attributes = $_POST['Datafile'];
			if ($model->save()) {
				$this->redirect(Yii::app()->getUser()->getReturnUrl());
			}
		}
		$this->render('create', array(
			'model' => $model
		));
	}
	public function actionUpdate() {
		$model = $this->loadModel();
		$file = CUploadedFile::getInstance($model, 'filepath');
		if (!empty($_POST['Datafile'])) {
			if (!is_null($file)) $model->setFileInstance($file);
			$model->attributes = $_POST['Datafile'];
			if ($model->save()) {
				$this->redirect(Yii::app()->getUser()->getReturnUrl());
			}
		}
		$this->render('update', array(
			'model' => $model,
		));
	}
/**
	 * Common code base for CRUD
	 * @see CController::actions()
	 */
	function actions() {
		return array(
			'index'		=>	'ext.actions.AdminAction',  // public function actionAdmin()
			'view'		=>	'ext.actions.ViewAction',  // public function actionView()
			'delete'	=>	'ext.actions.DeleteAction',  // public function actionDelete()
		);
	}
}
