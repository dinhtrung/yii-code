<?php
if(empty($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('core', 'Tags')=>array('index'),
	Yii::t('core', 'Create'),
);

?>

<h1> Create Tags </h1>
<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

