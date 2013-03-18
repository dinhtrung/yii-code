<?php
if(empty($this->breadcrumbs))
$this->breadcrumbs=array(
	'Trees'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

if(empty($this->menu))
$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' Tree', 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Manage') . ' Tree', 'url'=>array('admin')),
);
?>

<h1> Create Tree </h1>
<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

