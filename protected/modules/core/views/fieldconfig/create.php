<?php
/* @var $this FieldconfigController */
/* @var $model Fieldconfig */

$this->breadcrumbs=array(
	'Fieldconfigs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Fieldconfig', 'url'=>array('index')),
	array('label'=>'Manage Fieldconfig', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create Fieldconfig'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>