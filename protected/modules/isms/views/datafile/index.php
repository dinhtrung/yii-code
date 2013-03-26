<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms', 'File Manager') ,
);
if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'File'));
?>

<h1><?php echo $this->pageTitle = Yii::t('isms', 'File Manager'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
)); ?>
