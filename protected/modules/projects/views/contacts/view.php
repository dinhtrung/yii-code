<?php
/* @var $this ContactsController */
/* @var $model Contacts */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Contacts', 'url'=>array('index')),
	array('label'=>'Create Contacts', 'url'=>array('create')),
	array('label'=>'Update Contacts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Contacts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contacts', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Contacts :title Details', array(':title' => $model->getTitle())); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'first_name',
		'last_name',
		'order_by',
		'title',
		'birthday',
		'job',
		'company',
		'department',
		'type',
		'email',
		'email2',
		'url',
		'phone',
		'phone2',
		'fax',
		'mobile',
		'address1',
		'address2',
		'city',
		'state',
		'zip',
		'country',
		'jabber',
		'icq',
		'msn',
		'yahoo',
		'aol',
		'notes',
		'project',
		'icon',
		'owner',
		'private',
	),
)); ?>
