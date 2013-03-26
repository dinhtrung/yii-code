<?php

class FtpsettingController extends WebBaseController
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
			'create'	=>	array('class' => 'ext.actions.CreateAction',  'returnAction' => 'index'), // public function actionCreate()
			'update'	=>	array('class' => 'ext.actions.UpdateAction', 'returnAction' => 'index'), // public function actionUpdate()
			'delete'	=>	'ext.actions.DeleteAction',  // public function actionDelete()
		);
	}
}
