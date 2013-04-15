<?php


$this->breadcrumbs=array(
	'Blocks'=>array('index'),
	$model->title=>array('view','id'=>$model->bid),
	Yii::t('core', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocks', 'primaryKey' => 'bid'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('core', 'Update') . ' ' . Yii::t('core', 'Blocks :name', array(':name' => CHtml::encode($model->title))); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>
