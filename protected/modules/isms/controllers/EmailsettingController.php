<?php

class EmailsettingController extends WebBaseController
{

	public function allowedActions()
	{
		return;
	}

	public function init(){
		parent::init();
		// TODO: Configure settings for this controller
	}

	/**
	 * Common code base for CRUD
	 * @see CController::actions()
	 */
	function actions() {
		return array(
			'index'		=>	'ext.actions.AdminAction',  // public function actionAdmin()
			'view'		=>	'ext.actions.ViewAction',  // public function actionView()
			'create'	=>	'ext.actions.CreateAction',  // public function actionCreate()
			'update'	=>	'ext.actions.UpdateAction',  // public function actionUpdate()
			'delete'	=>	'ext.actions.DeleteAction',  // public function actionDelete()
		);
	}
}
