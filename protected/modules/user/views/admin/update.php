<?php
$this->breadcrumbs=array(
	(Yii::t('user', 'Users'))=>array('admin'),
	$model->username=>array('view','id'=>$model->id),
	(Yii::t('user', 'Update')),
);
?>

<h1><?php echo  Yii::t('user', 'Update User')." ".$model->id; ?></h1>

<?php echo $this->renderPartial('_menu', array(
		'list'=> array(
			CHtml::link(Yii::t('user', 'Create User'),array('create')),
			CHtml::link(Yii::t('user', 'View User'),array('view','id'=>$model->id)),
		),
	)); 

	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile)); ?>