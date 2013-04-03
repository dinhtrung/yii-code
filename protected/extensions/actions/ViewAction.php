<?php
/**
 * ViewAction class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'UpdateAction.php';
class ViewAction extends UpdateAction
{
	public $basePath = "";
	public $defaultView = "view";
	/**
	 * For Friendly URL, action views can use some other unique alias URL as substitute for table primary key.
	 * @var unknown_type
	 */
	public $aliasAttribute = NULL;
	public function process(){
	}
	public function model(){
		if (is_null($this->_model) AND is_string($this->modelClass) AND $this->aliasAttribute AND isset($_GET[$this->aliasAttribute])){
			$this->_model = CActiveRecord::model($this->modelClass)->findByAttributes(array($this->aliasAttribute => $_GET[$this->aliasAttribute]));
		}
		parent::model();
	}

}