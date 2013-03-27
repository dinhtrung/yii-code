<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('core', 'Tags')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('core', 'Update'),
);

?>

<h1> <?php echo Yii::t('core', 'Update');?> Tags #<?php echo $model; ?> </h1>
<?php
$this->renderPartial('_form', array('model'=>$model));
?>
