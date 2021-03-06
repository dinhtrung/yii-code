<?php
/**
 * CreateAction class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'BaseAction.php';
class CreateAction extends BaseAction
{
	public $basePath = "";
	/**
	 * The name of the default view when viewParam GET parameter is not provided by user.
	 * @var string defaultView
	 */
	public $defaultView = "create";

	/**
	 * File Attributes
	 */
	public $fileAttributes = array();

	/**
	 * Return method after create
	*/
	public $returnMethod = "view";
	/**
	 * use $_GET to provide default
	 */
	public $useDefault = TRUE;
	/**
	 * Load the model by modelClass specified
	 */
	public function model() {
		if(is_null($this->_model) AND is_string($this->modelClass))
		{
			$this->_model=new $this->modelClass;
		}
		if (is_null($this->_model) OR !($this->_model instanceof CModel))
			throw new CException("Please specify the modelClass attribute", 500);
		if ($this->useDefault && isset($_GET)){
			$this->_model->setAttributes($_GET);
		}
	}
	/**
	 * Process the create request
	 */
	function process() {
		$this->_model->setScenario("insert");
		$this->ajaxValidate();
		if (! Yii::app()->request->isAjaxRequest && isset($_POST[$this->modelClass])) {
			$this->_model->setAttributes($_POST[$this->modelClass]);
			foreach ($this->fileAttributes as $attribute){
				$files = CUploadedFile::getInstances($this->_model, $attribute);
				if (empty($files)) continue;
				elseif (count($files) == 1) $this->_model->$attribute = $files[0];
				else $this->_model->$attribute = $files;
			}
			if ($this->_model->save()){
				/*
				 * Handle AJAX request
				*/
				if( Yii::app()->request->isAjaxRequest ) {
					Yii::app()->clientScript->scriptMap['jquery.js'] = false;
					echo CJSON::encode( array(
							'status' => 'success',
							'content' => 'ModelName successfully created',
					));
					exit;
				} else {
					if (is_array($pk = $this->_model->getPrimaryKey())){
						$redirect = array_merge(array($this->returnMethod), $pk);
					} else {
						$redirect = array($this->returnMethod, "id" => $pk);
					}
					$this->getController()->redirect($redirect);
				}
			}
		}
	}
}