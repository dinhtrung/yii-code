<?php
/**
 * AdminAction class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'BaseAction.php';
class SearchAction extends BaseAction
{
	/**
	 * The name of the default view when viewParam GET parameter is not provided by user.
	 * @var string defaultView
	 */
	public $defaultView = "admin";

	/**
	* Place your logic here.
	*/
    public function process()
    {
    	$this->_model->setScenario('search');
    	if (isset($_GET[$this->modelClass])){
    		$this->_model->setAttributes($_GET[$this->modelClass]);
    	}
   	}
   	/**
   	* Override the loading of model if needed.
   	* @see BaseAction::model()
   	*/
   	public function model(){
   		if (is_null($this->_model) AND is_string($this->modelClass)){
	   		$this->_model=new $this->modelClass;
   		}
   	}
   	/**
   	* Override the render process needed.
   	* @see BaseAction::render()
   	*/
   	public function render(){
   		$this->getController()->render($this->view,array( 'model'=>$this->_model, ));
   	}
}