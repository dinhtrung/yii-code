<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Syntax')	=>	array('index'),$model->fid	=>	array_merge(array('view'),$model->getPrimaryKey()),

	Yii::t('app', 'Update'),
);
$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update')." ".Yii::t('app', 'Syntax') . " " . $model->fid; ?></h1>
<?php $this->renderPartial('_form', array('model' => $model)); ?>