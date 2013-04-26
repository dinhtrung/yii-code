<?php
/* @var $this FieldconfigController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fieldconfigs',
);

$this->menu=array(
	array('label'=>'Create Fieldconfig', 'url'=>array('create')),
	array('label'=>'Manage Fieldconfig', 'url'=>array('admin')),
);
?>

<h1>Fieldconfigs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
