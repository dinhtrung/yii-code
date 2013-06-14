<?php

class DefaultController extends WebBaseController
{
	public function allowedActions(){
		return 'index';
	}


	public function actionIndex()
	{
		$models = DirectoryHelper::directory_map(Yii::getPathOfAlias('projectbank.models'));
		foreach ($models as $file){
			$className = basename($file, ".php");
			$class = new $className;
		}
		$this->render('index');
	}
}