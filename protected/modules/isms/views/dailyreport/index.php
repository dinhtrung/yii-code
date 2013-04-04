<?php
$this->breadcrumbs=array(
	'Dailyreports',
);

$this->menu=array(
	array('label'=>'Create Dailyreport', 'url'=>array('create')),
	array('label'=>'Manage Dailyreport', 'url'=>array('admin')),
);
?>

<h1>Dailyreports</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
