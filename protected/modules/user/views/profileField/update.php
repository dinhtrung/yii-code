<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Profile Fields')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('user', 'Update'),
);
?>

<h1><?php echo Yii::t('user', 'Update ProfileField ').$model->id; ?></h1>

<?php echo $this->renderPartial('_menu', array(
		'list'=> array(
			CHtml::link(Yii::t('user', 'Create Profile Field'),array('create')),
			CHtml::link(Yii::t('user', 'View Profile Field'),array('view','id'=>$model->id)),
		),
	));
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>