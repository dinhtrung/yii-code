<?php
/* @var $this NotesController */
/* @var $model Notes */

$this->breadcrumbs=array(
	'Notes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Notes', 'url'=>array('index')),
	array('label'=>'Create Notes', 'url'=>array('create')),
	array('label'=>'View Notes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Notes', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update Notes :title', array(':title' => $model->getTitle())); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>