<?php

$this->breadcrumbs=array(
	Yii::t('core', 'Files')	=>	array(Yii::t('core', 'index')),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('core', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'File', 'primaryKey' => 'id'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('core', 'Update') . ' ' . Yii::t('core', 'Files :name', array(':name' => CHtml::encode($model))); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>
