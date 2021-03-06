<?php


$this->breadcrumbs=array(
	Yii::t('cms', 'Files')	=>	array('index'),
	$model->name,
	);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'File', 'primaryKey' => 'id'));
?>

<h1>
<?php echo $this->pageTitle = Yii::t('cms', 'View') . ' ' . Yii::t('cms', 'Files  :name', array(':name' => CHtml::encode($model->title))); ?> 
</h1>

<div>
<?php $this->beginWidget("CMarkdown");
echo $model->description;
$this->endWidget(); ?>

</div>

<?php  $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'name',
		'path',
		'parent_id',
		'version',
		'ext',
		'size',
		'type',
		'entity',
		'pkey',
array(
					'name'=>'createtime',
					'value' =>Yii::app()->getLocale()->getDateFormatter()->formatDateTime($model->createtime, 'medium', 'medium')),
array(
					'name'=>'updatetime',
					'value' =>Yii::app()->getLocale()->getDateFormatter()->formatDateTime($model->updatetime, 'medium', 'medium')),
),
)); ?>

