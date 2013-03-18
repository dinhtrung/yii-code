<?php
/**
 * BaseAction class file.
 *
 * BaseAction is an abstract class that extends CViewAction, support
 * multiple views per action.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 ISTT Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */
abstract class BaseAction extends CViewAction
{
	/**
	 * Name of the CModel class used to validate and/or save instance
	 * @var string $modelClass
	 */
	public $modelClass;
	/**
	 * CModel class instance
	 * @var CModel $_model
	 */
	public $_model;
	/**
	 * Perform ajax validation or not
	 * @var boolean $performAjaxValidation
	 */
	public $performAjaxValidation = TRUE;
	/**
	 * The base path for the views.
	 * @var string basePath
	 */
	public $basePath = "";
	/**
	 * The name of the default view when viewParam GET parameter is not provided by user.
	 * @var string defaultView
	 */
	public $defaultView = "index";

	public function __construct($controller, $id){
		parent::__construct($controller, $id);
		if (empty($this->modelClass)){
			$this->modelClass = ucfirst($this->getController()->getId());
		}
	}
    public function run()
    {
	    $this->model();
		$this->process();
		$this->resolveView($this->getRequestedView());
		if($this->layout!==null)
		{
			$layout=$this->getController()->layout;
			$this->getController()->layout=$this->layout;
		}
		$this->onBeforeRender($event=new CEvent($this));
		if(!$event->handled) {
			$this->render();
			$this->onAfterRender(new CEvent($this));
		}
		if($this->layout!==null) $this->getController()->layout=$layout;
    }

    /**
     * Process request from user.
     * Place your main logic here
     */
    public function process() {}

    /**
     * Render different view based on Request type.
     */
    public function render(){
		if( Yii::app()->request->isAjaxRequest ) {
		    // Stop jQuery from re-initialization
	    	Yii::app()->clientScript->scriptMap['jquery.js'] = false;
	        echo CJSON::encode( array(
		        	'status' => 'failure',
		        	'content' => $this->getController()->renderPartial( $this->view, array(
		          	'model' => $this->_model
	        	),
	        	true, true ),
			));
	      	Yii::app()->end();
	    } else {
	    	$this->getController()->render($this->view, array('model' => $this->_model));
	    }
	}
	/**
	 * Load the model specified in modelClass into class _model variables
	 * @throws CHttpException
	 */
	public function model(){
		if(is_null($this->_model) OR !($this->_model instanceof CActiveRecord))
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
	}

	/**
	 * Perform validation through Ajax
	 */
	public function ajaxValidate(){
		if (! $this->performAjaxValidation) return;
		if ( Yii::app()->request->isAjaxRequest && isset($_POST['ajax']) && $_POST['ajax'] == strtolower($this->modelClass) . '-form') {
			echo CActiveForm::validate($this->_model);
			exit;
		}
	}
}
