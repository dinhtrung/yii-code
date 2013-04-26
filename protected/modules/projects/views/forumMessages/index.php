<?php
/* @var $this ForumMessagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Forum Messages',
);

$this->menu=array(
	array('label'=>'Create ForumMessages', 'url'=>array('create')),
	array('label'=>'Manage ForumMessages', 'url'=>array('admin')),
);
?>

<h1>Forum Messages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
