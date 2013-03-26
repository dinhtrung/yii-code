<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Ftpfilename')		=>	array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->renderPartial('_menu');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create') ." ". Yii::t('app', 'Ftpfilename'); ?></h1>
<?php $this->renderPartial('_form', array('model' => $model)); ?>