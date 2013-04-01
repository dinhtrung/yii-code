<?php


$this->breadcrumbs = array(
	Yii::t('cms', "Nodes"),
	Yii::t('cms', 'Index'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Node'));
?>

<h1><?php echo $this->pageTitle = Yii::t('cms', "Nodes"); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
