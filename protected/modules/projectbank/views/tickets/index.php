<?php
$this->breadcrumbs=array(
	'Tickets',
);

$this->menu=array(
	array('label'=>'Create Tickets','url'=>array('create')),
	array('label'=>'Manage Tickets','url'=>array('admin')),
);
?>

<h1>Tickets</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
