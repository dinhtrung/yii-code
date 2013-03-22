<?php

class DefaultController extends Controller
{
	function actionIndex(){
		$model = GenericTable::model('authassignment');
		$dataProvider = new CActiveDataProvider($model);
		$this->render('index', array('model' => $model, 'dataProvider' => $dataProvider));
	}
}