<?php

class RegistrationController extends WebBaseController
{
	public $defaultAction = 'registration';
	public function allowedActions(){
		return 'registration, captcha';
	}


	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return (isset($_POST['ajax']) && $_POST['ajax']==='registration-form')?array():array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
	/**
	 * Registration user
	 */
	public function actionRegistration() {
            $model = new RegistrationForm;

			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
			{
				echo UActiveForm::validate(array($model));
				Yii::app()->end();
			}

		    if (Yii::app()->user->id) {
		    	$this->redirect(Yii::app()->controller->module->profileUrl);
		    } else {
		    	if(isset($_POST['RegistrationForm'])) {
					$model->attributes=$_POST['RegistrationForm'];
					if($model->validate())
					{
						$soucePassword = $model->password;
						$model->activkey=UserModule::encrypting(microtime().$model->password);
						$model->password=UserModule::encrypting($model->password);
						$model->verifyPassword=UserModule::encrypting($model->verifyPassword);
						$model->createtime=time();
						$model->lastvisit=((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin)?time():0;
						$model->role=0;
						$model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);

						if ($model->save()) {
							if (Yii::app()->controller->module->sendActivationMail) {
								$activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey, "email" => $model->email));
								Yii::import('ext.mail.*');
								$message = new YiiMailMessage;
								$message->setBody(Yii::t('user', "Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)), 'text/plain');
								$message->setSubject(Yii::t('user', "You registered from {site_name}",array('{site_name}'=>Yii::app()->name)));
								// Send a reply for notice the user
								$message->setFrom(array(Yii::app()->setting->get('Webtheme', 'serverEmail', Yii::app()->params['adminEmail']) => Yii::app()->setting->get('Webtheme', 'siteName', Yii::app()->name)));
								$message->addTo($model->email, $model->name);
								Yii::app()->mail->send($message);
							}

							if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
									$identity=new UserIdentity($model->username,$soucePassword);
									$identity->authenticate();
									Yii::app()->user->login($identity,0);
									$this->redirect(Yii::app()->controller->module->returnUrl);
							} else {
								if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
									Yii::app()->user->setFlash('registration',Yii::t('user', "Thank you for your registration. Contact Admin to activate your account."));
								} elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
									Yii::app()->user->setFlash('registration',Yii::t('user', "Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(Yii::t('user', 'Login'),Yii::app()->controller->module->loginUrl))));
								} elseif(Yii::app()->controller->module->loginNotActiv) {
									Yii::app()->user->setFlash('registration',Yii::t('user', "Thank you for your registration. Please check your email or login."));
								} else {
									Yii::app()->user->setFlash('registration',Yii::t('user', "Thank you for your registration. Please check your email."));
								}
								$this->refresh();
							}
						}
					}
				}
			    $this->render('/user/registration',array('model'=>$model));
		    }
	}
}