<?php
class FileController extends WebBaseController {
	private $path;
	public function allowedActions() {
		return 'index, view';
	}
	/**
	 * Using this folder as root for files
	 * @see WebBaseController::init()
	 */
	public function init() {
		parent::init();
		$this->path = Yii::getPathOfAlias('webroot.files');
	}
	function actions() {
		return array(
			'index'	=>	'ext.actions.BrowseAction',
			'admin'	=>	'ext.actions.AdminAction',
			'view'	=>	'ext.actions.ViewAction',
			'delete'	=>	'ext.actions.DeleteAction',
			'settings'	=>	'ext.actions.SettingsAction',
			'tcreate'	=>	array(
				'class' =>	'ext.actions.ViewAction',
				'fileAttributes'	=>	'name',
			),
		);
	}
	/**
	 * Create a new item
	 */
	public function actionCreate() {
		$model = new File;
		if (!empty($_POST['File'])) {
			$model->setAttributes($_POST['File']);
			$model->name = CUploadedFile::getInstance($model, 'name');
			$model->path = $this->path;
			if ($model->save()) {
				$this->redirect(array(
					'view',
					'id' => $model->id
				));
			}
		}
		if (Yii::app()->request->isAjaxRequest) $this->renderPartial('_miniform', array(
			'model' => $model,
			'relation' => $relation
		));
		else $this->render('create', array(
			'model' => $model
		));
	}
	public function actionUpdate() {
		$model = $this->loadModel();
		if (!empty($_POST['File'])) {
			$model->setAttributes($_POST['File']);
			$model->name = CUploadedFile::getInstance($model, 'name');
			$model->path = $this->path;
			if ($model->save()) {
				$this->redirect(array(
					'view',
					'id' => $model->id
				));
			}
		}
		$this->render('update', array(
			'model' => $model,
		));
	}
	/**
	 * Upload and process multiple files at once
	 */
	public function actionUpload() {
		Yii::import('ext.multimodelform.MultiModelForm');
		$model = new EntityForm();
		$item = new File();
		$valid = array();
		if (isset($_POST['EntityForm'])) {
			$model->setAttributes($_POST['EntityForm']);
			if ($model->validate()){
				$masterValues = $model->getAttributes();
				$masterValues['path'] = $this->path;
				if (MultiModelForm::save($item,$valid,$deleted,$masterValues)){
					$this->redirect('upload');
				} else {
					throw new CHttpException(500, "Cannot save the items");
				}
			}
		}
		$this->render('upload',array( 'model'=>$model, 'item' => $item, 'valid' => $valid));
	}

}
