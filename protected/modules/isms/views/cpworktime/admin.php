<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Cpworktime')	=>	array(Yii::t('app', 'index')),
);

$this->renderPartial('_menu');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Manage'). " ".Yii::t('app', 'Cpworktime'); ?></h1>
<blockquote> <p> <?php echo Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?> </p> </blockquote>
<?php
$btn = array();
if (Yii::app()->getUser()->checkAccess('Cpworktime.Update')) $btn[] = '{update}';
if (Yii::app()->getUser()->checkAccess('Cpworktime.Delete')) $btn[] = '{delete}';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cpworktime-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'c',
		't',
		array(
			'class'=>'EButtonColumnWithClearFilters',
			'viewButtonUrl' => 'Yii::app()->controller->createUrl("view",$data->primaryKey)',
			'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",$data->primaryKey)',
			'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",$data->primaryKey)',
						'template' => implode(' ', $btn),
		),
	),
)); ?>
