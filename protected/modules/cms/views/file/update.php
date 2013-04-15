<?php

$this->breadcrumbs=array(
	Yii::t('cms', 'Files')	=>	array(Yii::t('cms', 'index')),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('cms', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'File', 'primaryKey' => 'id'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('cms', 'Update') . ' ' . Yii::t('cms', 'Files :name', array(':name' => CHtml::encode($model->title))); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>
