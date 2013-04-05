<?php

class DefaultController extends WebBaseController
{
	public function allowedActions(){
		return 'index';
	}


	public function actionIndex()
	{
		$model = new DefaultModel(NULL);
		$this->render('index', array('model' => $model));
	}
}