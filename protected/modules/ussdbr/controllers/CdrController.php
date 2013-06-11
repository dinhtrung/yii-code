<?php

class CdrController extends WebBaseController
{
	public function actionIndex(){
		$this->layout = '//layouts/column1';
		$model = new Cdr('search');
		$model->setAttributes(Yii::app()->getRequest()->getParam('Cdr'));
		$this->render('index', array('model' => $model));
	}

	public function actionView(){
		$this->layout = '//layouts/column1';
		$model = new Cdr('search');
		$model->setAttribute('cpid', Yii::app()->getRequest()->getParam('cpid'));
		$model->setAttributes(Yii::app()->getRequest()->getParam('Cdr'));
		$this->render('view', array('model' => $model));
	}
}
