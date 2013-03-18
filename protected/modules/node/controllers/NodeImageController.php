<?php

class NodeImageController extends WebBaseController
{

	public function allowedActions()
	{
		return 'index, view';
	}

	function actions() {
		return array(
			'create' 	=> 'ext.actions.CreateAction',
			'view' 		=> 'ext.actions.ViewAction',
			'update' 	=> 'ext.actions.UpdateAction',
			'delete' 	=> 'ext.actions.DeleteAction',
			'settings' 	=> 'ext.actions.SettingsAction',
		);
	}

	function actionIndex() {
		if (isset($_GET['tag'])){
			$this->_model = NodeImage::model()->taggedWith($_GET["tag"]);
			$this->_model = new CActiveDataProvider($this->_model);
		} else {
			$this->_model = new CActiveDataProvider('NodeImage');
		}
		$this->render("index", array("dataProvider" => $this->_model));
	}

}
