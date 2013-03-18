<?php

class NodeGalleryController extends WebBaseController
{

	public function allowedActions()
	{
		return 'index, view';
	}

	public function init(){
		parent::init();
	}

	function actions() {
		return array(
			'index'	=>	'ext.actions.BrowseAction',
			'create'	=>	'ext.actions.CreateAction',
			'update'	=>	'ext.actions.UpdateAction',
			'delete'	=>	'ext.actions.DeleteAction',
			'view'		=>	'ext.actions.ViewAction',
			'admin'		=>	'ext.actions.AdminAction',
			'plupload'	=>	array(
				'class'	=>	'ext.actions.PluploadAction',
			),
			'settings'	=>	array(
				'class'	=>	'ext.actions.SettingsAction'
			),
		);
	}
	public function actionUpload() {
		$model = $this->loadModel();
		$this->render("upload", array('model' => $model));
	}
}
