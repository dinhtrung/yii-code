<?php


$this->breadcrumbs = array(
	Yii::t('core', "Nodes"),
	Yii::t('core', 'Search'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Node'));
?>

<h1><?php echo $this->pageTitle = Yii::t('core', "Nodes"); ?></h1>
<?php echo CHtml::link(Yii::t('core', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
<?php

$this->widget('zii.widgets.CListView', array(
	'dataProvider'	=>	$model->search(),
	'itemView'		=>	'_view',
)); ?>
