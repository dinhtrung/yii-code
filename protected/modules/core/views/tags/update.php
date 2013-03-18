<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('tags', 'Tags')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

?>

<h1> <?php echo Yii::t('app', 'Update');?> Tags #<?php echo $model; ?> </h1>
<?php
$this->renderPartial('_form', array('model'=>$model));
?>
