<?php


$this->breadcrumbs = array(
	Yii::t('NodeModule.node', "Nodes"),
	Yii::t('app', 'Index'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Nodes'));
?>

<h1><?php echo $this->pageTitle = Yii::t('NodeModule.node', "Nodes"); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
