<?php
$this->breadcrumbs=array(
	Yii::t('isms', 'Datafile')	=>	'index',
);

$this->renderPartial('_menu');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Manage'). " ".Yii::t('isms', 'Datafile'); ?></h1>

<blockquote> <p> <?php echo Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?> </p> </blockquote>

<?php
$btn = array();
if (Yii::app()->getUser()->checkAccess('Datafile.View')) $btn[] = '{view}';
if (Yii::app()->getUser()->checkAccess('Datafile.Update')) $btn[] = '{update}';
if (Yii::app()->getUser()->checkAccess('Datafile.Delete')) $btn[] = '{delete}';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datafile-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
					'download:html',
					'createtime:datetime',
					array('name' => 'status', 'value' => 'Datafile::statusOption($data->status)', 'type' => 'html'),
					'filesize:number',
					array('header' => 'Số dòng ước tính', 'value' => 'round($data->filesize/13)', 'type' => 'number'),
		/*
					'uri',
					'filemime',
		*/
		array(
			'class'=>'EButtonColumnWithClearFilters',
						'template' => implode(' ', $btn),
		),
	),
)); ?>
