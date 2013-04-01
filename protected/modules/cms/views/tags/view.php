<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('cms', 'Tags')=>array('index'),
	$model->name,
	);

?>

<h1><?php echo Yii::t('cms', 'View');?> <?php echo Yii::t('cms', 'Tags');?> #<?php echo $model; ?></h1>

<?php
$locale = CLocale::getInstance(Yii::app()->language);

 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'frequency',
	),
)); ?>


