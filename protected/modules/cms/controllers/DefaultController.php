<?php

class DefaultController extends WebBaseController
{
	public function actionIndex(){
		$models = CFileHelper::findFiles(dirname(__FILE__) . '/../models');
		foreach ($models as $filepath){
			$className = ucfirst(basename($filepath, '.php'));
			try {
				$mdl = new $className;
			} catch (CException $e){
				Yii::trace("Cannot create model :mdl", array(':mdl' => $className));
			}
		}
	}
}
