<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Users')=>array('admin'),
	Yii::t('user', 'Manage'),
);
?>
<h1><?php echo $this->pageTitle = Yii::t('user', "Manage Users"); ?></h1>

<?php echo $this->renderPartial('_menu', array(
		'list'=> array(
			CHtml::link(Yii::t('user', 'Create User'),array('create')),
		),
	));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'username',
		'email:email',
		'createtime:date',
		'lastvisit:date',
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
		),
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
