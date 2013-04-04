<?php
$this->breadcrumbs=array(
	Yii::t('isms', 'Smsorders') =>array('index'),
	Yii::t('app', 'Create'),
);

$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create') . ' ' . Yii::t('app', 'Smsorder'). ' ' . CHtml::encode($model->title); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
