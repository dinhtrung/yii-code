<?php
$this->breadcrumbs=array(
	Yii::t('isms', 'Datafile')	=>	'index',
	$model->title	=>	array('view','id'=>$model->getPrimaryKey()),

	Yii::t('app', 'Update'),
);
$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update')." ".Yii::t('isms', 'Datafile') . " " . $model->title; ?></h1>
<?php $this->renderPartial('_form', array('model' => $model)); ?>