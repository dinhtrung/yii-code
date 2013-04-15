<?php


$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('cms', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Comments', 'primaryKey' => 'id'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('cms', 'Update') . ' ' . Yii::t('cms', 'Comments :name', array(':name' => CHtml::encode($model->title))); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>
