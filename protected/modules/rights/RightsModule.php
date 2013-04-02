<?php
/**
* Rights module class file.
*
* @author Christoffer Niska <cniska@live.com>
* @copyright Copyright &copy; 2010 Christoffer Niska
* @version 1.3.0
*
* DO NOT CHANGE THE DEFAULT CONFIGURATION VALUES!
*
* You may overload the module configuration values in your rights-module
* configuration like so:
*
* 'modules'=>array(
*     'rights'=>array(
*         'userNameColumn'=>'name',
*         'flashSuccessKey'=>'success',
*         'flashErrorKey'=>'error',
*     ),
* ),
*/
class RightsModule extends CWebModule
{
	/**
	* @property string the name of the role with superuser privileges.
	*/
	public $superuserName = 'Admin';
	/**
	* @property string the name of the guest role.
	*/
	public $authenticatedName = 'Authenticated';
	/**
	* @property string the name of the user model class.
	*/
	public $userClass = 'User';
	/**
	* @property string the name of the id column in the user table.
	*/
	public $userIdColumn = 'id';
	/**
	* @property string the name of the username column in the user table.
	*/
	public $userNameColumn = 'username';
	/**
	* @property boolean whether to enable business rules.
	*/
	public $enableBizRule = true;
	/**
	* @property boolean whether to enable data for business rules.
	*/
	public $enableBizRuleData = false;
	/**
	* @property string the flash message key to use for success messages.
	*/
	public $flashSuccessKey = 'RightsSuccess';
	/**
	* @property string the flash message key to use for error messages.
	*/
	public $flashErrorKey = 'RightsError';
	/**
	* @property boolean whether to install rights when accessed.
	*/
	public $install = false;
	/**
	* @property string the base url to Rights. Override when module is nested.
	*/
	public $baseUrl = '/rights';

	/**
	* @property string the style sheet file to use for Rights.
	*/
	public $cssFile;
	/**
	* @property boolean whether to enable debug mode.
	*/
	public $debug = false;

	private $_assetsUrl;

	/**
	* Initializes the "rights" module.
	*/
	public function init()
	{
		// Set required classes for import.
		$this->setImport(array(
			'rights.components.*',
			'rights.components.behaviors.*',
			'rights.components.dataproviders.*',
			'rights.controllers.*',
			'rights.models.*',
		));

		$rights = new Rights();
		$authassignment = new Authassignment();
		$authitem = new Authitem();
		$authitemchild = new Authitemchild();
		// Set the required components.
		$this->setComponents(array(
			'authorizer'=>array(
				'class'=>'RAuthorizer',
				'superuserName'=>$this->superuserName,
			),
			'generator'=>array(
				'class'=>'RGenerator',
			),
		));

		// Normally the default controller is Assignment.
		$this->defaultController = 'assignment';

		// Set the installer if necessary.
		if( $this->install===true )
		{
			$this->setComponents(array(
				'installer'=>array(
					'class'=>'RInstaller',
					'superuserName'=>$this->superuserName,
					'authenticatedName'=>$this->authenticatedName,
					'guestName'=>Yii::app()->user->guestName,
					'defaultRoles'=>Yii::app()->authManager->defaultRoles,
				),
			));

			// When installing we need to set the default controller to Install.
			$this->defaultController = 'install';
		}
	}

	/**
	* @return RightsAuthorizer the authorizer component.
	*/
	public function getAuthorizer()
	{
		return $this->getComponent('authorizer');
	}

	/**
	* @return RightsInstaller the installer component.
	*/
	public function getInstaller()
	{
		return $this->getComponent('installer');
	}

	/**
	* @return RightsGenerator the generator component.
	*/
	public function getGenerator()
	{
		return $this->getComponent('generator');
	}

	/**
	* @return the current version.
	*/
	public function getVersion()
	{
		return '1.3.0';
	}
}
