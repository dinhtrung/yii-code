<?php
/**
 * BrowseAction class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'BaseAction.php';
class BrowseAction extends BaseAction
{
	public $basePath = "";
	public $defaultView = "index";
	public $criteria = array();
	public $pagination = array();
	public $sort = array();

	/**
	* Place your logic here.
	*/
    public function model() {
    	if (is_array($this->pagination) && empty($this->pagination['pageSize'])){
    		$this->pagination['pageSize'] = Yii::app()->setting->get("Webtheme", "pageSize", 10);
    	} elseif ($this->pagination instanceof CPagination){
    		$this->pagination->setPageSize(Yii::app()->setting->get("Webtheme", "pageSize", 10));
    	}
    	if (is_null($this->_model) AND is_string($this->modelClass)){
    		$this->_model = new CActiveDataProvider(new $this->modelClass, array(
    			'criteria'		=>	$this->criteria,
    			'pagination'	=>	$this->pagination,
    			'sort'			=>	$this->sort,
    		));
    	}
    	if (is_null($this->_model) OR !($this->_model instanceof CActiveDataProvider))
    		throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
    }
    /**
    * Render different view based on Request type.
    */
    public function render(){
    	$this->getController()->render($this->view, array('dataProvider' => $this->_model));
    }
}