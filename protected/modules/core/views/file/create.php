<?php
if(empty($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('file', 'Files') =>array('index'),
	Yii::t('app', 'Create'),
);

if(empty($this->menu))
$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' File', 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Manage') . ' File', 'url'=>array('admin')),
);
?>

<h1> Create File </h1>
<?php
$this->renderPartial('_form', array( 'model' => $model));

?>

