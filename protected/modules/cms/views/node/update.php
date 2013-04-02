<?php


$this->breadcrumbs=array(
	Yii::t('cms', 'Nodes')	=>'index',
	$model->title=>array('view','id'=>$model->id),
	Yii::t('cms', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Node', 'primaryKey' => 'id'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('cms', 'Update') . ' ' . Yii::t('cms', 'Nodes :name', array(':name' => CHtml::encode($model))); ?>
</h1>

<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>
