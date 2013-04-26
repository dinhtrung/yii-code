<?php
/* @var $this FieldconfigController */
/* @var $model Fieldconfig */

$this->breadcrumbs=array(
	'Fieldconfigs'=>array('index'),
	$model->name=>array('view','id'=>$model->name),
	'Update',
);

$this->menu=array(
	array('label'=>'List Fieldconfig', 'url'=>array('index')),
	array('label'=>'Create Fieldconfig', 'url'=>array('create')),
	array('label'=>'View Fieldconfig', 'url'=>array('view', 'id'=>$model->name)),
	array('label'=>'Manage Fieldconfig', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update Fieldconfig :title', array(':title' => $model->getTitle())); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>