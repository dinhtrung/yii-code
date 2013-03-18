<?php


$this->breadcrumbs = array(
	Yii::t('file', 'Files'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'File'));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'List') . ' ' . Yii::t('file', 'Files'); ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
