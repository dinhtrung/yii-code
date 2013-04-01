<?php
if(empty($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('cms', 'Files') =>array('index'),
	Yii::t('cms', 'Create'),
);

if(empty($this->menu))
$this->menu=array(
	array('label'=>Yii::t('cms', 'List') . ' File', 'url'=>array('index')),
	array('label'=>Yii::t('cms', 'Manage') . ' File', 'url'=>array('admin')),
);
?>

<h1> Create File </h1>
<?php
$this->renderPartial('_form', array( 'model' => $model));

?>

