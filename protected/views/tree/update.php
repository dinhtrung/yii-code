<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	'Trees'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

if(empty($this->menu))
$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' Tree', 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' Tree', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View') . ' Tree', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Manage') . ' Tree', 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('app', 'Update');?> Tree #<?php echo $model; ?> </h1>
<?php
$this->renderPartial('_form', array('model'=>$model));
?>
