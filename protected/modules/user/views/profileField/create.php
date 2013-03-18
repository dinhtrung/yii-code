<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Profile Fields')=>array('admin'),
	Yii::t('user', 'Create'),
);
?>
<h1><?php echo Yii::t('user', 'Create Profile Field'); ?></h1>

<?php echo $this->renderPartial('_menu',array(
		'list'=> array(),
	)); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>