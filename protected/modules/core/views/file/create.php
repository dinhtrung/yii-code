<?php
if(empty($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('core', 'Files') =>array('index'),
	Yii::t('core', 'Create'),
);

if(empty($this->menu))
$this->menu=array(
	array('label'=>Yii::t('core', 'List') . ' File', 'url'=>array('index')),
	array('label'=>Yii::t('core', 'Manage') . ' File', 'url'=>array('admin')),
);
?>

<h1> Create File </h1>
<?php
$this->renderPartial('_form', array( 'model' => $model));

?>

