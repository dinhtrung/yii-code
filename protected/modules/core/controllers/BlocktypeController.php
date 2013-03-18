<?php

class BlocktypeController extends WebBaseController
{

	public function allowedActions()
	{
		return '';
	}
	public function init(){
		parent::init();
		// TODO: Configure settings for this controller
	}

	/**
	 * Common code base for CRUD
	 * @see CController::actions()
	 */
	function actions() {
		return array(
			'view'		=>	'ext.actions.ViewAction',
			'index'		=>	'ext.actions.AdminAction',
			'create'	=>	'ext.actions.CreateAction',
			'duplicate'	=>	'ext.actions.DuplicateAction',
			'update'	=>	'ext.actions.UpdateAction',
			'delete'	=>	'ext.actions.DeleteAction',
		);
	}

	/**
	* Copy existing item to a new one
	**/
	public function actionClone(){
		$source = $this->loadModel();
		$model = new Blocktype;

				$this->performAjaxValidation($model, 'blocktype-form');

		if(!empty($_POST['Blocktype']))
		{
			$model->attributes = $_POST['Blocktype'];


			if($model->save()) {

      				$this->redirect(array('view','id'=>$model->btid));
			}
		}

		$this->render('update',array('model'=>$source));
	}

}
