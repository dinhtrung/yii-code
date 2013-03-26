<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Ftpfilename')	=>	array('index'),$model->cid	=>	array_merge(array('view'),$model->getPrimaryKey()),

	Yii::t('app', 'Update'),
);
$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update')." ".Yii::t('app', 'Ftpfilename') . " " . $model->cid; ?></h1>
<?php $this->renderPartial('_form', array('model' => $model)); ?>