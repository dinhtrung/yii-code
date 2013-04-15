<?php


$this->breadcrumbs=array(
	Yii::t('cms', 'Categories') => array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('cms', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Categories', 'primaryKey' => 'id'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('cms', 'Update') . ' ' . Yii::t('cms', 'Category :name', array(':name' => CHtml::encode($model->title))); ?>
</h1>

<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>
