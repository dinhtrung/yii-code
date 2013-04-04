<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Sendsms')	=>	array('index'),$model->receiver	=>	array_merge(array('view'),$model->getPrimaryKey()),

	Yii::t('app', 'Update'),
);
$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update')." ".Yii::t('app', 'Sendsms') . " " . $model->receiver; ?></h1>
<?php $this->renderPartial('_form', array('model' => $model)); ?>