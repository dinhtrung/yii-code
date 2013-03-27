<?php
/**
 * UpdateAction class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'BaseAction.php';
class UpdateAction extends BaseAction
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
	public $defaultView = "update";

	/**
	* File Attributes
	*/
	public $fileAttributes = array();

    /**
    * Load the model by modelClass specified
    */
    public function model() {
    	if (is_null($this->_model) AND is_string($this->modelClass)) {
    		$classname = $this->modelClass;
			if(isset($_GET['id'])){
				$this->_model = $classname::model($this->modelClass)->findbyPk(urldecode($_GET['id']));
			} else {
				$pkeys = $classname::model($this->modelClass)->getTableSchema()->primaryKey;
				if (is_string($pkeys) && isset($_GET[$pkeys])){
					$this->_model = $classname::model($this->modelClass)->findbyPk(urldecode($_GET[$pkeys]));
				} elseif (is_array($pkeys)){
					$tmp = array_flip($pkeys);
					foreach ($pkeys as $field) {
						if (isset($_GET[$field])) $tmp[$field] = urldecode($_GET[$field]);
						else { $tmp = NULL; break; }
					}
					if (! is_null($tmp)) $this->_model = $classname::model($this->modelClass)->findbyPk($tmp);
				}
			}
		}
		if($this->_model === NULL)
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
    }
    /**
     * Process the create request
     */
    public function process() {
    	$this->_model->setScenario("update");
    	$this->ajaxValidate();
    	if (isset($_POST[$this->modelClass])) {
    		$this->_model->setAttributes($_POST[$this->modelClass]);
    		foreach ($this->fileAttributes as $attribute){
    			$files = CUploadedFile::getInstances($this->_model, $attribute);
    			if (empty($files)) continue;
    			elseif (count($files) == 1) $this->_model->$attribute = $files[0];
    			else $this->_model->$attribute = $files;
    		}
    		if ($this->_model->save()){
    			if( Yii::app()->request->isAjaxRequest ) {
    				Yii::app()->clientScript->scriptMap['jquery.js'] = false;
    				echo CJSON::encode( array(
    			          'status' => 'success',
    			          'content' => 'ModelName successfully updated.',
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