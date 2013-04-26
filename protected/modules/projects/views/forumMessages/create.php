<?php
/* @var $this ForumMessagesController */
/* @var $model ForumMessages */

$this->breadcrumbs=array(
	'Forum Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ForumMessages', 'url'=>array('index')),
	array('label'=>'Manage ForumMessages', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create ForumMessages'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>