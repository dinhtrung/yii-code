<?php
/**
 * SettingsAction class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.istt.com.vn/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * SettingsAction is used to provide configuration through ActiveRecord with scenario `settings`.
 * You can do validation for the POST array to see if the model work okay.
 * If Okay, it will set the global setting component for this setting.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @version 0.1
 * @package
 * @since 1.0
 */

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CreateAction.php';
class SettingsAction extends CreateAction
{
	/**
	 * The name of the default view when viewParam GET parameter is not provided by user.
	 * @var string defaultView
	 */
	public $defaultView = "settings";

    public function process()
    {
		$this->_model->setScenario("settings");
		if (isset($_POST[$this->modelClass])) {
			$this->_model->setAttributes($_POST[$this->modelClass]);
			if ($this->_model->validate()){
				Yii::app()->setting->set($this->modelClass, $_POST[$this->modelClass]);
				Yii::app()->setting->commit();
				$this->getController()->redirect(Yii::app()->getUser()->getReturnUrl());
			}
		} else {
			$this->_model->setAttributes(Yii::app()->setting->get($this->modelClass));
		}
    }
}