<?php

class SiteController extends WebBaseController
{
	public function actionIndex(){
		$this->layout = 'column1';
		$model = new Cdr('search');
		$model->setAttributes(Yii::app()->getRequest()->getParam('Cdr'));
		$this->render('overview', array('model' => $model));
	}

	public function actionView(){
		$this->layout = 'column1';
		$model = new Cdr('search');
		$model->setAttribute('cpid', Yii::app()->getRequest()->getParam('cpid'));
		$model->setAttributes(Yii::app()->getRequest()->getParam('Cdr'));
		$this->render('view', array('model' => $model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
}