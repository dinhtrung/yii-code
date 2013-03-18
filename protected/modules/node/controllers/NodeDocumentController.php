<?php

class NodeDocumentController extends WebBaseController
{

	public function allowedActions()
	{
		return 'index, view';
	}

	public function init(){
		parent::init();
	}

	function actions() {
		return array(
			'index'		=> 'ext.actions.BrowseAction',
			'view' 		=> 'ext.actions.ViewAction',
			'create'	=> 'ext.actions.CreateAction',
			'update'	=> 'ext.actions.UpdateAction',
			'delete' 	=> 'ext.actions.DeleteAction',
			'settings' 	=> 'ext.actions.SettingsAction',
		);
	}

	/**
	 * Browse by tags
	 */
	public function actionTags()
	{
		$model = NodeDocument::model();
		if (isset($_GET["tag"])) {
			$model->taggedWith($_GET["tag"]);
		}
		$dataProvider=new CActiveDataProvider($model);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Browse by tags and category
	 */
	public function actionCategory()
	{
		$model = NodeDocument::model();
		if (isset($_GET["cid"])) {
			$model->cid = $_GET["cid"];
		}
		$dataProvider =	$model->search();
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* List available items
	**/
	public function actionAdmin()
	{
		$model=new NodeDocument('search');
		if (intval(Yii::app()->request->getParam('clearFilters'))==1) {
		    EButtonColumnWithClearFilters::clearFilters($this,$model);
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	* Using EExcelView to create excel file.
	**/
	public function actionExport()
	{
		$model=new NodeDocument('search');
		$this->render('export',array(
			'model'=>$model,
		));
	}
	/**
	 * Configure form for this model
	 */
	public function actionConfigure(){
		$model = new NodeDocument("configure");
		$model->setAttributes(Yii::app()->setting->get("document"));
		if (isset($_POST["NodeDocument"])) {
			try {
				DirectoryHelper::safe_directory(Yii::getPathOfAlias($_POST["NodeDocument"]["alias"]));
			} catch (CException $e){
				unset($_POST["NodeDocument"]["alias"]);
			}
			Yii::app()->setting->set("document", $_POST["NodeDocument"]);

		}
		$this->render("config", array("model" => $model));
	}
}
