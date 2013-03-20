<?php


$this->breadcrumbs=array(
'Comments'=>array('index'),
	$model->id,
	);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Comments', 'primaryKey' => 'id'));
?>

<h1>
<?php echo $this->pageTitle = Yii::t('core', 'View') . ' ' . Yii::t('core', 'Comments  :name', array(':name' => CHtml::encode($model))); ?>
</h1>

<div>
<?php $this->beginWidget("CMarkdown");
echo $model->comment;
$this->endWidget(); ?>

</div>
