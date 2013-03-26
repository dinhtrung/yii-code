<?php
class IsmsModule extends CWebModule {
	public static function getDbComponent() {
		return 'db';
	}
	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		// import the module-level models and components
		$this->setImport(array(
			'isms.models.*',
			'isms.components.*',
		));
		$this->defaultController = 'Campaign';
	}
	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		} else return false;
	}
}
