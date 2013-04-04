<?php
$this->breadcrumbs=array(
	'Dailyreports'=>array('index'),
	$model->id_dailyreport=>array('view','id'=>$model->id_dailyreport),
	'Update',
);

$this->menu=array(
	array('label'=>'List Dailyreport', 'url'=>array('index')),
	array('label'=>'Create Dailyreport', 'url'=>array('create')),
	array('label'=>'View Dailyreport', 'url'=>array('view', 'id'=>$model->id_dailyreport)),
	array('label'=>'Manage Dailyreport', 'url'=>array('admin')),
);
?>

<h1>Update Dailyreport <?php echo $model->id_dailyreport; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>