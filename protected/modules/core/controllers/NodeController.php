<?php

class NodeController extends WebBaseController
{
	public function allowedActions()
	{
		return 'index, view, tags, category';
	}

	public function init(){
		parent::init();
	}

	/**
	* Filter Node by category
	*/
	public function actionCategory(){
		if (isset($_GET["id"]))
			$cid = Category::model()->findByAttributes(array('id' => $_GET['id']));
		elseif (isset($_GET["title"]))
			$cid = Category::model()->findByAttributes(array('title' => urldecode($_GET['title'])));
		else $this->redirect(array("index"), TRUE);
		if (is_null($cid)) throw new CHttpException(404, "Page not found.");
		$dataProvider = new Node();
		$dataProvider->cid = $cid->id;
		$dataProvider = $dataProvider->search();
		$this->render('index',array(
						'dataProvider'=>$dataProvider,
		));
	}

	public function actionTags()
	{
		$model = Node::model();
		if (isset($_GET["name"])) {
			$model->taggedWith($_GET["name"]);
		} else $this->redirect(array("index"));
		$dataProvider=new CActiveDataProvider($model);
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	public function actionSearch(){
		$model = NULL;
		if (isset($_POST['q'])){
			$searchCriteria = new stdClass();
			$pages = new CPagination();
			$pages->pageSize = 20;
			$searchCriteria->select = '*';
			//$searchCriteria->filters = array();
			$searchCriteria->query = $_POST['q'];
			$searchCriteria->paginator = $pages;
			//$searchCriteria->groupby = $groupby;
			//$searchCriteria->orders = array('createtime' => 'DESC');
			$searchCriteria->from = 'node';
			$model = Yii::app()->sphinx->search($searchCriteria); // interator result*/
			/*Yii::app()->search
				//->select('id')
				->from('node')
				->where($_POST['q'])
				//->filters()
				//->groupby($groupby)
				->orderby(array('createtime' => 'DESC'))
				->limit(0, 30);
			$resIterator = Yii::app()->search->search();*/
			//$resIterator = Yii::app()->search->searchRaw();

		}
		$this->render("results", array('model' => $model));
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
			"search"	=>	array(
				"class"	=>	"ext.actions.AdminAction",
				"defaultView"	=>	'search',
			),
			"view"	=>	array(
				"class"	=>	"ext.actions.ViewAction",
				'aliasAttribute'	=>	'alias',
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
