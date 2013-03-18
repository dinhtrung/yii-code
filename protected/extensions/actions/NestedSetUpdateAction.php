<?php
/**
 * NestedSetUpdateAction class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'UpdateAction.php';
class NestedSetUpdateAction extends UpdateAction
{
	/**
	 * The name of the default view when viewParam GET parameter is not provided by user.
	 * @var string defaultView
	 */
	public $defaultView = "update";
	public function process() {
		$this->_model->setScenario("update");
		$pkey = $this->_model->getTableSchema()->primaryKey;
		if(! Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST[$this->modelClass])) {
			$this->_model->setAttributes($_POST[$this->modelClass]);
			if (empty($_POST[$this->modelClass]['root'])){
				if (! $this->_model->isRoot()) $this->_model->moveAsRoot();
			} elseif (! is_null($root = CActiveRecord::model($this->modelClass)->findByPk($_POST[$this->modelClass]['root']))){
				$this->_model->saveNode();
				if ($root->$pkey != $this->_model->$pkey) $this->_model->moveAsLast($root);
			} else throw new CHttpException(500, Yii::t('app',
				"Invalid root node ID: %d", array('%d' => $_POST[$this->modelClass]['root'])));
			$this->getController()->redirect(array(
					'view',
					'id'	=>	$this->_model->$pkey
				)
			);
		}
	}
}