<?php
/**
 * NestedSetSortAction class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'UpdateAction.php';
class NestedSetSortAction extends UpdateAction
{
	/**
	 * The name of the default view when viewParam GET parameter is not provided by user.
	 * @var string defaultView
	 */
	public $defaultView = "sort";

	/**
	* Place your logic here.
	*/
    public function process()
    {
    	if (isset($_POST['Order']) && Yii::app()->getRequest()->getIsAjaxRequest()){
			Yii::app()->getUser()->setFlash('message', $_POST['Order']);
			$order = explode(',', $_POST['Order']);
			foreach ($order as $nid) {
				$node = CActiveRecord::model($this->modelClass)->findByPk($nid);
				if (is_null($node)) continue;
				$node->moveAsLast($this->_model);
				unset($node);
			}
			echo "<div class='flash-success'>";
			echo Yii::t('category', 'Sucessfully update order.');
			echo "</div>";
			Yii::app()->end();
		}
   	}
   	/**
   	* Override the loading of model if needed.
   	* @see UpdateAction::model()
   	public function model(){}
   	*/
   	/**
   	* Override the render process needed.
   	* @see UpdateAction::render()
   	public function render(){}
   	*/
}