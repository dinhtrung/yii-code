<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('cms', 'Tags')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('cms', 'Update'),
);

?>

<h1> <?php echo Yii::t('cms', 'Update');?> Tags #<?php echo $model; ?> </h1>
<?php
$this->renderPartial('_form', array('model'=>$model));
?>
