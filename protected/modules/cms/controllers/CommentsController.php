<?php

class CommentsController extends WebBaseController
{
	public function allowedActions()
	{
		return 'index,view';
	}

	public function init(){
		parent::init();
	}

	/**
	* Configure Controller Actions
	* Action class are stored in `ext.actions`.
	*/
	public function actions(){
		return array(
			"index"	=>	array(
				"class"	=>	"ext.actions.BrowseAction",
			),
			"report"	=>	array(
				"class"	=>	"ext.actions.BrowseAction",
				"defaultView"	=>	"excelIndex",
			),
			"view"	=>	array(
				"class"	=>	"ext.actions.ViewAction",
			),
			"export"	=>	array(
				"class"	=>	"ext.actions.BrowseAction",
				"defaultView"	=>	"printView",
			),
			"create"	=>	array(
				"class"	=>	"ext.actions.CreateAction",
			),
			"update"	=>	array(
				"class"	=>	"ext.actions.UpdateAction",
			),
			"delete"	=>	array(
				"class"	=>	"ext.actions.DeleteAction",
			),
			"admin"	=>	array(
				"class"	=>	"ext.actions.AdminAction",
			),
			"settings"	=>	array(
				"class"	=>	"ext.actions.SettingsAction",
			),
		);
	}
}
