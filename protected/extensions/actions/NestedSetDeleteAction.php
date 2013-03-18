<?php
/**
 * NestedSetDeleteAction class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'UpdateAction.php';
class NestedSetDeleteAction extends UpdateAction
{
	public $basePath = "";
	/**
	 * The name of the default view when viewParam GET parameter is not provided by user.
	 * @var string defaultView
	 */
	public $defaultView = "delete";
    public function process() {
    	if (Yii::app()->request->isPostRequest){
    		$this->_model->deleteNode();
    		$this->getController()->redirect('index', TRUE, 200);
    	}
    }
}