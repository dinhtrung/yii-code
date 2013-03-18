<?php
if(empty($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('tags', 'Tags')=>array('index'),
	Yii::t('app', 'Create'),
);

?>

<h1> Create Tags </h1>
<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

