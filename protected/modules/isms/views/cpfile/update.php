<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Cpfile')	=>	array('index'),
	$model->cid	=>	array_merge(array('view'),$model->getPrimaryKey()),
	Yii::t('app', 'Update'),
);
$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update')." ".Yii::t('isms', 'Cpfile') . " " . $model->cid; ?></h1>
<?php $this->renderPartial('_form', array('model' => $model)); ?>