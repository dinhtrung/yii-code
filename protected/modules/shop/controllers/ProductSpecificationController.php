<?php

class ProductSpecificationController extends WebBaseController
{
	public function actions(){
		return array(
				'index'	=>	'ext.actions.IndexAction',
				'admin'	=>	'ext.actions.AdminAction',
				'create'	=>	'ext.actions.CreateAction',
				'update'	=>	'ext.actions.UpdateAction',
				'delete'	=>	'ext.actions.DeleteAction',
				'view'	=>	'ext.actions.ViewAction',
		);
	}
}
