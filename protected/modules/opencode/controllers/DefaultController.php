<?php

class DefaultController extends WebBaseController
{
	public function actionIndex(){
		$model = new Cdr('search');
		$model->setAttributes(Yii::app()->getRequest()->getParam('Cdr'));
		$this->render('overview', array('model' => $model));
	}

	public function actionView(){
		$model = new Cdr('search');
		$model->setAttribute('cpid', Yii::app()->getRequest()->getParam('cpid'));
		$model->setAttributes(Yii::app()->getRequest()->getParam('Cdr'));
		$this->render('view', array('model' => $model));
	}

	function actions(){
		return array(
			'admin'	=>	array(
					'class' => 'ext.actions.AdminAction',
					'model'	=>	new Cdrlog('search'),
			),
		);
	}
}