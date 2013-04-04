<?php
$this->breadcrumbs=array(
	Yii::t('isms', 'Smsorders') =>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update') . ' ' . Yii::t('app', 'Smsorder'). ' ' . CHtml::encode($model->title); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
