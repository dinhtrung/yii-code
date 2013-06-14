<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Projects','url'=>array('index')),
	array('label'=>'Create Projects','url'=>array('create')),
	array('label'=>'Update Projects','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Projects','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Projects','url'=>array('admin')),
);
?>

<h1>View Projects #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'createtime:datetime',
		'updatetime:datetime',
	),
)); ?>


<?php
// All related tickets...
	$tickets = Tickets::model()->roots();
	$tickets->getDbCriteria()->addColumnCondition(array('project_id' => $model->primaryKey));
	$dataProvider = new CActiveDataProvider($tickets);
?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'projects-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$tickets,
	'columns'=>array(
		'title',
		'body',
		'createtime:datetime',
		'updatetime:datetime',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'viewButtonUrl'	=>	'array("tickets/view", "id" => $data->id)',
			'updateButtonUrl'	=>	'array("tickets/update", "id" => $data->id)',
			'deleteButtonUrl'	=>	'array("tickets/delete", "id" => $data->id)',
		),
	),
)); ?>
