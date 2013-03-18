<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Profile Fields')=>array('admin'),
	Yii::t('user', $model->title),
);
?>
<h1><?php echo Yii::t('user', 'View Profile Field #').$model->varname; ?></h1>

<?php echo $this->renderPartial('_menu', array(
		'list'=> array(
			CHtml::link(Yii::t('user', 'Create Profile Field'),array('create')),
			CHtml::link(Yii::t('user', 'Update Profile Field'),array('update','id'=>$model->id)),
			CHtml::linkButton(Yii::t('user', 'Delete Profile Field'),array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure to delete this item?')),
		),
	));
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'varname',
		'title',
		'field_type',
		'field_size',
		'field_size_min',
		'required',
		'match',
		'range',
		'error_message',
		'other_validator',
		'widget',
		'widgetparams',
		'default',
		'position',
		'visible',
	),
)); ?>
