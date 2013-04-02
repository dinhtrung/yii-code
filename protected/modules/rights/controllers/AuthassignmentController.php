<?php

class AuthassignmentController extends WebBaseController
{

	public function allowedActions()
	{
		return '';
	}
	/**
	 * Common code base for CRUD
	 * @see CController::actions()
	 */
	function actions() {
		return array(
			'index'		=>	'ext.actions.AdminAction',
			'view'		=>	'ext.actions.ViewAction',
			'create'	=>	'ext.actions.CreateAction',
			'duplicate'	=>	'ext.actions.DuplicateAction',
			'update'	=>	'ext.actions.UpdateAction',
			'delete'	=>	'ext.actions.DeleteAction',
		);
	}
}
