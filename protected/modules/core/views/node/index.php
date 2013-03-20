<?php


$this->breadcrumbs = array(
	Yii::t('core', "Nodes"),
	Yii::t('core', 'Index'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Node'));
?>

<h1><?php echo $this->pageTitle = Yii::t('core', "Nodes"); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
