<?php
/**
* Rights filter class file.
*
* @author Christoffer Niska <cniska@live.com>
* @copyright Copyright &copy; 2010 Christoffer Niska
* @since 0.7
*/
class RightsFilter extends CFilter
{
	protected $_allowedActions = array();
	public $authItem = '';

	/**
	* Performs the pre-action filtering.
	* @param CFilterChain $filterChain the filter chain that the filter is on.
	* @return boolean whether the filtering process should continue and the action
	* should be executed.
	*/
	protected function preFilter($filterChain)
	{
		// By default we assume that the user is allowed access
		$allow = true;

		$user = Yii::app()->getUser();
		$controller = $filterChain->controller;
		$action = $filterChain->action;

		// Check if the action should be allowed
		if( $this->_allowedActions!=='*' && in_array($action->id, $this->_allowedActions)===false )
		{
			// Append the module id to the authorization item name
			// in case the controller called belongs to a module
			if( ($module = $controller->getModule())!==null )
				$this->authItem .= ucfirst($module->id).'.';

			// Append the controller id to the authorization item name
			$this->authItem .= ucfirst($controller->id);

			// Check if user has access to the controller
			if( $user->checkAccess($this->authItem.'.*')!==true )
			{
				// Append the action id to the authorization item name
				$this->authItem .= '.'.ucfirst($action->id);

				// Check if the user has access to the controller action
				if( $user->checkAccess($this->authItem)!==true ){
					$allow = false;
				}
			}
			
			// Add missing authItem on development environment...
			if (YII_DEBUG){
				$item = new Authitem();
				$item->name = ($module = $controller->getModule())?((ucfirst($module->id))."." . ucfirst($controller->id) . "." . $action->id):(ucfirst($controller->id) . "." . $action->id);
				$item->type = CAuthItem::TYPE_OPERATION;
				$item->data = serialize(NULL);
				$item->save();
			}
		}
		

		// User is not allowed access, deny access
		if( $allow===false )
		{
			$controller->accessDenied();
		 	return false;
		}

		// Authorization item did not exist or the user had access, allow access
		return true;
	}

	/**
	* Sets the allowed actions.
	* @param string $allowedActions the actions that are always allowed separated by commas,
	* you may also use star (*) to represent all actions.
	*/
	public function setAllowedActions($allowedActions)
	{
		if( $allowedActions==='*' )
			$this->_allowedActions = $allowedActions;
		else
			$this->_allowedActions = preg_split('/[\s,]+/', $allowedActions, -1, PREG_SPLIT_NO_EMPTY);
	}
}
