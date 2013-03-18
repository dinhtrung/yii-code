<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('block', 'Block') =>array('index'),
	$model->title	=>	array('view','id'=>$model->bid),
	Yii::t('app', 'Configure'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocks', 'primaryKey' => 'bid'));
?>

<h1> <?php echo $this->pageTitle = Yii::t('app', 'Configure') . ' ' . Yii::t('block', 'Blocks :name', array(':name' => CHtml::encode($model))); ?></h1>

<div class="form">
	<?php echo $form; ?>
</div>