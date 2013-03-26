<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Cpfiles') =>	array('index'),
	CHtml::encode($model) =>	array_merge(array('view'),$model->getPrimaryKey()),
);

$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'View')." ".Yii::t('app', 'Cpfile') . " " . $model->cid; ?></h1>

<?php $this->beginClip('basic'); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'status',
	),
)); ?>

<?php $this->endClip(); ?>


<?php  $this->widget('CTabView', array(
			'tabs' => array(
				'basic'=>array(
			          'title'	=>	Yii::t('app', 'Basic'),
			          'content'	=> $this->clips['basic'],
			    ),
			    			)
		)
	);
?>

