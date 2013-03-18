<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('tags', 'Tags')=>array('index'),
	$model->name,
	);

?>

<h1><?php echo Yii::t('app', 'View');?> <?php echo Yii::t('tags', 'Tags');?> #<?php echo $model; ?></h1>

<?php
$locale = CLocale::getInstance(Yii::app()->language);

 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'frequency',
	),
)); ?>


