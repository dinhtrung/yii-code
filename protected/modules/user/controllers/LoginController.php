<?php

class LoginController extends WebBaseController
{
	public $defaultAction = 'login';
	public function allowedActions(){
		return 'login';
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->user->returnUrl);
	}

	private function lastViset() {
		$lastVisit = User::model()->findByPk(Yii::app()->user->id);
		$lastVisit->saveAttributes(array('updatetime' => time()));
	}

}