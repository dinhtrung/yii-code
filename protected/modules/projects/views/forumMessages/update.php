<?php
/* @var $this ForumMessagesController */
/* @var $model ForumMessages */

$this->breadcrumbs=array(
	'Forum Messages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ForumMessages', 'url'=>array('index')),
	array('label'=>'Create ForumMessages', 'url'=>array('create')),
	array('label'=>'View ForumMessages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ForumMessages', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update ForumMessages :title', array(':title' => $model->getTitle())); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>