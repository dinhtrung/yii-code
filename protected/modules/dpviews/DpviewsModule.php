<?php

class DpviewsModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'dpviews.models.*',
			'dpviews.components.*',
		));

		/*
		 * Cache all available model for this module...
		 */
		$model = new DefaultModel(NULL);
		foreach ($model->getDbConnection()->getSchema()->tableNames as $dbtable){
			$table = $model->removePrefix($dbtable, FALSE);
			$mdl = DefaultModel::getModel($table);
		}
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
