<?php

class WebmenuController extends WebBaseController
{

	public function allowedActions()
	{
		return '';
	}

	public function init(){
		parent::init();
	}

	function actions() {
		return array(
			'index'		=>	'ext.actions.AdminAction',
			'view'		=>	'ext.actions.ViewAction',
			'create'	=>	'ext.actions.NestedSetCreateAction',
			'duplicate'	=>	'ext.actions.NestedSetDuplicateAction',
			'update'	=>	'ext.actions.NestedSetUpdateAction',
			'delete'	=>	'ext.actions.NestedSetDeleteAction',
			'sort'		=>	'ext.actions.NestedSetSortAction',
		);
	}
}
