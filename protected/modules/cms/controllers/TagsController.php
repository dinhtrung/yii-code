<?php

class TagsController extends WebBaseController
{

	public function allowedActions()
	{
		return 'suggestTags, view, index';
	}

	public function init(){
		parent::init();
	}
	/**
	 * Using Actions to provide some basic actions
	 * @see CController::actions()
	 */
	function actions() {
		return array(
				'index'	=>	'ext.actions.BrowseAction',
				'admin'	=>	'ext.actions.AdminAction',
				'view'	=>	'ext.actions.ViewAction',
				'delete'	=>	'ext.actions.DeleteAction',
				'create'	=>	'ext.actions.ViewAction',
				'update'	=>	'ext.actions.UpdateAction',
		);
	}
	/**
	 * Suggests tags based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestTags()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=Tags::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}
}
