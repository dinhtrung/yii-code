<?php
class FilterController extends WebBaseController {
	public function allowedActions() {
		return;
	}
	/**
	 * Common code base for CRUD
	 * @see CController::actions()
	 */
	function actions() {
		return array(
				'index'		=>	'ext.actions.AdminAction',  // public function actionIndex()
				'create'	=>	'ext.actions.CreateAction',  // public function actionCreate()
				'update'	=>	'ext.actions.UpdateAction',  // public function actionUpdate()
				'delete'	=>	'ext.actions.DeleteAction',  // public function actionDelete()
				'view'		=>	'ext.actions.ViewAction',  // public function actionDelete()
		);
	}
}
