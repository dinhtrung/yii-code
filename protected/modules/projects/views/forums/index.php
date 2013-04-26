<?php
/* @var $this ForumsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Forums',
);

$this->menu=array(
	array('label'=>'Create Forums', 'url'=>array('create')),
	array('label'=>'Manage Forums', 'url'=>array('admin')),
);
?>

<h1>Forums</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
