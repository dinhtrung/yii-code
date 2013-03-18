<?php


$this->breadcrumbs=array(
	'Blocks'=>array('index'),
	$model->title=>array('view','id'=>$model->bid),
	Yii::t('app', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocks', 'primaryKey' => 'bid'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('app', 'Update') . ' ' . Yii::t('Block', 'Blocks :name', array(':name' => CHtml::encode($model))); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>
