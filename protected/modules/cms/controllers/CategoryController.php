<?php

class CategoryController extends WebBaseController
{

	public function allowedActions()
	{
		return '';
	}

	/**
	 * Only display the root nodes
	 */
	public function actionRoots()
	{
		$dataProvider = new CActiveDataProvider(Category::model()->roots());
		$this->render('index',array(
			'dataProvider'	=>	$dataProvider,
		));
	}
	/**
	 * Testing action Nested Set Create and Update
	 */
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
