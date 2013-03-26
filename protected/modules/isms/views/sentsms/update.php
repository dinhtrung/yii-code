<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Sentsms')	=>	array('index'),$model->time	=>	array('view','id'=>$model->getPrimaryKey()),

	Yii::t('app', 'Update'),
);
$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update')." ".Yii::t('app', 'Sentsms') . " " . $model->time; ?></h1>
<?php $this->renderPartial('_form', array('model' => $model)); ?>