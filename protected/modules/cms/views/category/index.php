<?php


$this->breadcrumbs = array(
	Yii::t('cms', 'Categories'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Categories'));
?>

<h1><?php echo $this->pageTitle = Yii::t('cms', 'Categories'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
