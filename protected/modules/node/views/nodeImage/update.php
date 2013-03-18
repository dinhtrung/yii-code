<?php


$this->breadcrumbs=array(
	'Nodes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Nodes', 'primaryKey' => 'id'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('app', 'Update') . ' ' . Yii::t('Node', 'Nodes :name', array(':name' => CHtml::encode($model))); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>
