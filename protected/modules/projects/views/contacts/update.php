<?php
/* @var $this ContactsController */
/* @var $model Contacts */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contacts', 'url'=>array('index')),
	array('label'=>'Create Contacts', 'url'=>array('create')),
	array('label'=>'View Contacts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Contacts', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update Contacts :title', array(':title' => $model->getTitle())); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>