<?php
/**
 * BrowseAction class file.
 *
 *To use this action, in your view file, default to `index.php`, you should use AutoCountGridView
 *	$this->widget('ext.widgets.grid.AutoCountGridView', array(
   		 'dataProvider'=> $model,
	    'filter'=>null,
	    'columns'=>array('column1','column2'),
	    'selectableRows'=>0,
	    'template'=>"{summary}\n<div style='overflow:auto'>{items}</div>\n{pager}",
	    'count_get_variable'=>'count',
	));
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'BrowseAction.php';
class BrowseAutoCountAction extends BrowseAction
{

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
    		$this->_model = new AutoCountSqlDataProvider($this->modelClass, array(
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