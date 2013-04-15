<?php


$this->breadcrumbs=array(
	'Web Menus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('core', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Web Menus', 'primaryKey' => 'id'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('core', 'Update') . ' ' . Yii::t('core', 'Web Menus :name', array(':name' => CHtml::encode($model->label))); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>
