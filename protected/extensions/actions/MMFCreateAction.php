<?php
/**
 * MMFCreateActionAction class file.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CreateAction.php';
class MMFCreateAction extends CreateAction
{
	/**
	 * The name of the default view when viewParam GET parameter is not provided by user.
	 * @var string defaultView
	 */
	public $defaultView = "create";
	/**
	 * The name of the related class
	 * @var string itemClass
	 */
	public $itemClass;
	/**
	 * The instance of the related class
	 * @var string _item
	 */
	public $_item;
	/**
	 * Required by MultimodelForm
	 * @var unknown_type
	 */
	public $_valid = array();
	/**
	 * Master values attributes
	 */
	public $masterAttributes = array();

	/**
	* Place your logic here.
	*/
    public function process()
    {
    	Yii::import('ext.multimodelform.MultiModelForm');
		if(!empty($_POST[$this->modelClass])) {
			$this->_model->setAttributes($_POST[$this->modelClass]);
			if ($this->_model->save()) {
				$masterValues = $this->_model->getAttributes(TRUE);
				foreach ($masterValues as $attr => $value){
					if (! in_array($attr, $this->masterAttributes)) unset($masterValues[$attr]);
				}
				MultiModelForm::save($item,$valid,$deleted,$masterValues);
				$this->getController()->redirect(array(
					'view',
					'id'	=>	$this->_model->{$this->_model->getTableSchema()->primaryKey}
				)
			);
		}
	}
   	}
   	/**
   	* Override the loading of model if needed.
   	* @see CreateAction::model()
   	*/
   	public function model(){
   		parent::model();
   		if (is_null($this->_item) AND is_string($this->itemClass))
   		{
   			$this->_item=new $this->itemClass;
   		}
   		if (is_null($this->_item) OR !($this->_item instanceof CModel))
   			throw new CException("Please specify the itemClass attribute", 500);
   	}
   	/**
   	* Override the render process needed.
   	* @see CreateAction::render()
   	*/
   	public function render(){
   		$this->getController()->render($this->view, array('model' => $this->_model, 'items' => $this->_item, 'valid' => $this->_valid));
   	}
}