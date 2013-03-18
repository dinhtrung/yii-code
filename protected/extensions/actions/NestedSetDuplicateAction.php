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
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'NestedSetUpdateAction.php';
class NestedSetDuplicateAction extends NestedSetUpdateAction
{
	/**
	 * The name of the default view when viewParam GET parameter is not provided by user.
	 * @var string defaultView
	 */
	public $defaultView = "create";
	/**
	* Array of attribute should be removed from original model
	*/
	public $removeAttributes = array('root', 'lft', 'rgt', 'level');

	/**
	* Load the model by modelClass specified
	*/
	public function model() {
		parent::model();
		$primaryKey = $this->_model->getTableSchema()->primaryKey;
		if (is_string($primaryKey)) $primaryKey = array($primaryKey);
		$this->removeAttributes = array_merge($this->removeAttributes, $primaryKey);
		$this->_model->unsetAttributes($this->removeAttributes);
		$this->_model->setIsNewRecord(TRUE);
	}
	/**
	* Process the create request
	*/
	public function process() {
		$this->_model->setScenario("insert");
		if(! Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST[$this->modelClass])) {
			$this->_model->setAttributes($_POST[$this->modelClass]);
			if (empty($_POST[$this->modelClass]['root'])){
				// This is a root node
				$this->_model->saveNode();
			} elseif (! is_null($root = CActiveRecord::model($this->modelClass)->findByPk($_POST[$this->modelClass]['root']))){
				// Attach new item to the root node
				$this->_model->appendTo($root);
			} else throw new CHttpException(500,
				Yii::t('app', "Invalid root node ID: %d", array('%d' => $_POST[$this->modelClass]['root'])));
			$this->getController()->redirect(array(
					'view',
					'id'	=>	$this->_model->{$this->_model->getTableSchema()->primaryKey}
				)
			);
		}
	}
}