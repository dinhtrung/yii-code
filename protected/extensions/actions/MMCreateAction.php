<?php
/**
 * MMCreateAction class file.
 * Using MultiModel extension to create group - item relation
 * Usage:
 * - In your controller, using actions() function to load this action.
 * 		function actions(){
 * 			return array(
 * 				'createMany'	=>	array(
 * 					'ext.actions.MMCreateAction',
 * 					'modelClass'		=>	'[MyMasterModel]',
 * 					'secondaryClass'	=>	'[MySecondaryModel]',
 * 					'masterAttributes'	=>	array('masterAttr1' => 'secondaryAttr1', 'masterAttr2' => 'secondAttr2')
 * 		}
 * - In your views, use the following variable:
 * 		$model : The MasterModel instance
 * 		$[MySecondaryModel] : The secondary model instance
 * 		$valid[MySecondaryModel]: An array contain the valid Secondary Model
 */

class MMCreateAction extends CViewAction
{
	public $modelClass;
	public $_model;
	public $secondaryClass;
	public $_secondary;
	public $masterAttributes = array();
	public $validSecondary = array();
	public $deleteSecondary = array();
	public $performAjaxValidation = TRUE;
	// Override CViewAction properties
	public $basePath = "";
	public $defaultView = "create";


    public function run()
    {
    	Yii::import('ext.multimodelform.MultiModelForm');
        $controller = $this->getController();
        // Instantiate the model models if needed
	    if(is_string($this->modelClass))
		{
			$this->_model=new $this->modelClass;
		}
		if(! ($this->_model instanceof CActiveRecord))
		throw new CException("Please specify the modelClass as the name of model CActiveRecord class.", 500);
        // Instantiate the secondary models if needed
	    if(is_string($this->secondaryClass))
		{
			$this->_secondary=new $this->secondaryClass;
		}
		if(! ($this->_secondary instanceof CActiveRecord))
		throw new CException("Please specify the secondaryClass as the name of secondary CActiveRecord class.", 500);

		if ($this->performAjaxValidation && method_exists($controller, "performAjaxValidation")) {
        	$controller->performAjaxValidation($this->_model, strtolower($this->modelClass . '-form'));
        }

        if (isset($_POST[$this->modelClass])) {
            $this->_model->attributes = $_POST[$this->modelClass];
            if (! $this->_model->save()) throw new CHttpException(500, "Failed to save " . $this->modelClass);
        	foreach ($this->masterAttributes as $primaryAttribute => $secondaryAttribute){
        		if ($tmp = $this->_model->getAttribute($primaryAttribute)){
        			$this->masterAttributes[$secondaryAttribute] = $tmp;
        		}
        	}
			if (! MultiModelForm::save($this->_secondary, $this->validSecondary, $this->deleteSecondary, $this->masterAttributes)) {
				Yii::log("Cannot save secondary model " . $this->secondaryClass, "error", "MMCreateAction");
            }
			$controller->redirect(Yii::app()->user->returnUrl);
            Yii::app()->end();
        }
        $this->resolveView($this->getRequestedView());
		if($this->layout!==null)
		{
			$layout=$controller->layout;
			$controller->layout=$this->layout;
		}

		$this->onBeforeRender($event=new CEvent($this));
		if(!$event->handled)
		{
	        $controller->render($this->view, array(
	            'model' 			=> $this->_model,
	        	$this->secondaryClass			=> $this->_secondary,
	        	'valid' . $this->secondaryClass	=>	$this->validSecondary,
	        ));
			$this->onAfterRender(new CEvent($this));
		}

		if($this->layout!==null) $controller->layout=$layout;

    }
}