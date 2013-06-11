<?php
/* @var $this UcbController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ucbs',
);

$this->menu=array(
	array('label'=>'Create Ucb', 'url'=>array('create')),
	array('label'=>'Manage Ucb', 'url'=>array('admin')),
);
?>

<h1>Ucbs <?php echo $model->tableName(); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->search(),
	'itemView'=>'_view',
)); ?>
