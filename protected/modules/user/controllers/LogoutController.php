<?php

class LogoutController extends WebBaseController
{
	public $defaultAction = 'logout';
	function allowedActions() {
		return 'logout';
	}


	/**
	 * Logout the current user and redirect to returnLogoutUrl.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->controller->module->returnLogoutUrl);
	}

}