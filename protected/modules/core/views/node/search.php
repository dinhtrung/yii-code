<?php


$this->breadcrumbs = array(
	Yii::t('node', "Nodes"),
	Yii::t('app', 'Search'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Node'));
?>

<h1><?php echo $this->pageTitle = Yii::t('node', "Nodes"); ?></h1>
<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
<?php

$this->widget('zii.widgets.CListView', array(
	'dataProvider'	=>	$model->search(),
	'itemView'		=>	'_view',
)); ?>
