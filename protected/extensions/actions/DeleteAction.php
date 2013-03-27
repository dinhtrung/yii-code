<?php
/**
 * DeleteAction class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'UpdateAction.php';
class DeleteAction extends UpdateAction
{
	/**
	 * The base path for the views.
	 * @var string basePath
	 */
	public $basePath = "";
	/**
	 * The name of the default view when viewParam GET parameter is not provided by user.
	 * @var string defaultView
	 */
	public $defaultView = "delete";
	function process() {
		if (Yii::app()->request->isPostRequest){
			$this->_model->delete();
			if( Yii::app()->request->isAjaxRequest ) {
				Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				echo CJSON::encode( array(
						'status' => 'success',
						'content' => 'ModelName successfully deleted.',
				));
				exit;
			} else {
				$this->getController()->redirect(Yii::app()->getUser()->getReturnUrl());
			}
		}
	}

}