<?php

class FieldsController extends WebBaseController
{
	public function allowedActions(){
		return '';
	}

	function actions(){
		return array(
			'index'		=>	'ext.actions.AdminAction',
			'create'	=>	'ext.actions.CreateAction',
			'update'	=>	'ext.actions.UpdateAction',
			'delete'	=>	'ext.actions.DeleteAction',
			'duplicate'	=>	'ext.actions.DuplicateAction',
		);
	}
}
