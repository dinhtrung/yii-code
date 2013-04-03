<?php
/**
 * Action support for return auto complete list for CJuiAutoComplete widget.
 * Usage:
 *  - In your controller, include this action
 * 'aclist'=>array(
 *        'class'=>'application.extensions.EAutoCompleteAction',
 *        'model'=>'My', //My model's class name
 *        'attribute'=>'my_name', //The attribute of the model i will search
 *      ),
 * - In your form, add CJuiAutoComplete widget
 *  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
 *	'attribute'=>'my_name',
 *        'model'=>$model,
 *        'sourceUrl'=>array('my/aclist'),
 *        'options'=>array(
 *          'minLength'=>'3',
 *        ),
 *        'htmlOptions'=>array(
 *          'size'=>45,
 *          'maxlength'=>45,
 *        ),
 *  )); ?>
 **/
class EAutoCompleteAction extends CAction
{
	public $model;
	public $attribute;
	private $results = array();

	public function run()
	{
		if(isset($this->model) && isset($this->attribute)) {
			$criteria = new CDbCriteria();
			$criteria->compare($this->attribute, $_GET['term'], true);
			$model = new $this->model;
			foreach($model->findAll($criteria) as $m)
			{
				$this->results[] = $m->{$this->attribute};
			}

		}
		echo CJSON::encode($this->results);
	}
}