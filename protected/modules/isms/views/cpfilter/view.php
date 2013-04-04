<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Campaign Filters') =>	array('index'),$model->cid	=>	array_merge(array('view'),$model->getPrimaryKey()),

);

$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'View')." ".Yii::t('app', 'CampaignFilter') . " " . $model->cid; ?></h1>

<?php $this->beginClip('basic'); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'type',
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

