<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('core', 'Block') =>array('index'),
	$model->title	=>	array('view','id'=>$model->getPrimaryKey()),
	Yii::t('core', 'Configure'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocks', 'primaryKey' => 'bid'));
?>

<h1> <?php echo $this->pageTitle = Yii::t('core', 'Configure') . ' ' . Yii::t('core', 'Blocks :name', array(':name' => CHtml::encode($model->title))); ?></h1>

<div class="form">
	<?php echo $form; ?>
</div>