<?php
/* @var $this ForumMessagesController */
/* @var $model ForumMessages */

$this->breadcrumbs=array(
	'Forum Messages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ForumMessages', 'url'=>array('index')),
	array('label'=>'Create ForumMessages', 'url'=>array('create')),
	array('label'=>'Update ForumMessages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ForumMessages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ForumMessages', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'ForumMessages :title Details', array(':title' => $model->getTitle())); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'root',
		'lft',
		'rgt',
		'level',
		'forum',
		'title',
		'body',
		'createtime',
		'updatetime',
		'author',
		'editor',
		'published',
	),
)); ?>
