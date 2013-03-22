<?php

class CategoryController extends WebBaseController
{
	public function actions(){
		return array(
				'index'	=>	'ext.actions.BrowseAction',
				'create'	=>	'ext.actions.CreateAction',
				'update'	=>	'ext.actions.UpdateAction',
				'delete'	=>	'ext.actions.DeleteAction',
				'view'	=>	'ext.actions.ViewAction',
				'admin'	=>	'ext.actions.AdminAction',
		);
	}
}
