<?php
$this->breadcrumbs=array(
	Yii::t('isms', 'Datafiles') =>	array('index'),
	CHtml::encode($model) =>	array('view','id'=>$model->getPrimaryKey()),
);

$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'View')." ".Yii::t('isms', 'Datafile') . " " . $model->title; ?></h1>

<?php $this->beginClip('basic'); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'description',
		'createtime:datetime',
		'updatetime:datetime',
		'filename',
		'uri',
		array('name' => 'path', 'value'	=>	$model->fileUri2Path(), 'type'	=>	'raw'),
		'filemime',
		'filesize:number',
		array('name' => 'status', 'value'	=>	Datafile::statusOption($model->status), 'type'	=>	'raw'),
	),
)); ?>

<?php $this->endClip(); ?>

<?php $this->beginClip('Campaign'); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'campaign-grid',
				'dataProvider'=>new CArrayDataProvider($model->campaigns),
				'columns'=>array(
					'title',
					'description',
					'sender',
					'template',
					),
				));
		?>

<?php $this->endClip(); ?>

<?php  $this->widget('CTabView', array(
			'tabs' => array(
				'basic'=>array(
			          'title'	=>	Yii::t('app', 'Basic'),
			          'content'	=> $this->clips['basic'],
			    ),
			    'Campaign'=>array(
			          'title'	=>	Yii::t('app', 'Campaign'),
			          'content'	=> $this->clips['Campaign'],
			    ),
			    			)
		)
	);
?>

