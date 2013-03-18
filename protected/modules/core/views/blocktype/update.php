<?php


$this->breadcrumbs=array(
	'Blocktypes'=>array('index'),
	$model->title=>array('view','id'=>$model->btid),
	Yii::t('app', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocktype', 'primaryKey' => 'btid'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('app', 'Update') . ' ' . Yii::t('blocktype', 'Blocktypes :name', array(':name' => CHtml::encode($model))); ?>
</h1>

<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>
