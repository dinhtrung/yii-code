<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
'Trees'=>array('index'),
	$model->title,
	);

if(empty($this->menu))
$this->menu=array(
		array('label'=>Yii::t('app', 'List Node'), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create Node'), 'url'=>array('create')),
		array('label'=>Yii::t('app', 'Update Node'), 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>Yii::t('app', 'Delete Node'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>Yii::t('app', 'Manage Node'), 'url'=>array('admin')),
		);
?>

<h1><?php echo Yii::t('app', 'View');?> <?php echo Yii::t('app', 'Tree');?> #<?php echo $model; ?></h1>

<?php
$locale = CLocale::getInstance(Yii::app()->language);

 $this->widget('zii.widgets.CDetailView', array(
'data'=>$model,
	'attributes'=>array(
		'title',
		'description',
		'id',
		'root',
		'lft',
		'rgt',
		'level',
),
	)); ?>


