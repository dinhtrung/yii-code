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


	/**
	 * Import block config from module blocktypes configuration....
	 * @TODO: Test if using exists Framework CConfiguration is okay?
	 */
	public function actionImport(){
		$modules = Yii::app()->getModules();
		foreach ($modules as $moduleId => $moduleConfig){
			$alias = "$moduleId.data.blocktype";
			if (! file_exists(Yii::getPathOfAlias($alias) . '.php')) continue;
			$config = new BlocktypeConfig('search', $alias);
			foreach ($config->findAll() as $blocktype){
				$blocktypeModel = new Blocktype();
				$blocktypeModel->setAttributes($blocktype->getAttributes());
				if ($blocktypeModel->save()){
					echo Yii::t('core', "Successfully install blocktype :title", array(':title' => $blocktypeModel->title));
				} else {
					echo CVarDumper::dumpAsString($blocktypeModel->getErrors(), 10, TRUE);
				}
			}
		}
	}
	/**
	 * Scan block types from modules configuration files
	 */
	public function actionExport(){
		$blocktype = Blocktype::model()->findAll();
		foreach ($blocktype as $mdl){
			$config = new BlocktypeConfig();
			$config->setAttributes($mdl->getAttributes());
			if ($config->save()){
				echo Yii::t('core', "Successfully export blocktype :title", array(':title' => $mdl->title));
			} else {
				echo CVarDumper::dumpAsString($config->getErrors(), 10, TRUE);
			}

		}
	}
}
