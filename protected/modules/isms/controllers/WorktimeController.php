<?php

class WorktimeController extends WebBaseController
{

	public function allowedActions()
	{
		return;
	}

	public function init(){
		parent::init();
	}

	/**
	 * Common code base for CRUD
	 * @see CController::actions()
	 */
	function actions() {
		return array(
			'index'		=>	'ext.actions.AdminAction',// public function actionAdmin()
			'create'	=>	array('class' => 'ext.actions.CreateAction', 'returnMethod'	=>	'index'),
			'update'	=>	array('class' => 'ext.actions.UpdateAction', 'returnMethod'	=>	'index'),
			'delete'	=>	'ext.actions.DeleteAction',  // public function actionDelete()
		);
	}
}
