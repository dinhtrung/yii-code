<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	Yii::t('opencode', 'Opencode'),
);
?>
<h1><?php echo $this->pageTitle = Yii::t('opencode', 'CDR Files processed'); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comments-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'filename',
	),
));