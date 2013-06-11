<?php
/* @var $this UcbController */
/* @var $model Ucb */

$this->breadcrumbs=array(
	'Ucbs'=>array('index'),
	'Devel',
);
$this->pageTitle = Yii::t('app', 'Table: %table', array('%table' => $model->tableName()));
?>
<h1><?php echo Yii::t('app', 'Table: <small>%table</small>', array('%table' => $model->tableName())); ?></h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php  
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>$model->getClassName() . '-grid',
	'dataProvider'=>$model->search(),
	'columns'	=>	$model->tableSchema->columnNames,
	'enableSorting'	=>	TRUE,
	'filter'=>$model,
)); ?>
