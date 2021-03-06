<?php


$this->breadcrumbs=array(
'Blocktypes'=>array('index'),
	$model->title,
	);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocktype', 'primaryKey' => 'btid'));
?>

<h1>
<?php echo $this->pageTitle = Yii::t('core', 'View') . ' ' . Yii::t('core', 'Blocktypes  :name', array(':name' => CHtml::encode($model->title))); ?>
</h1>

<div>
<?php $this->beginWidget("CMarkdown");
echo $model->description;
$this->endWidget(); ?>

</div>

<?php  $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'component',
		'callback',
		'viewfile',
	),
)); ?>



<h2><?php echo CHtml::link(Yii::t('core', 'Blocks of type :title', array(':title'	=>	$model->title)), array('/core/block'));?></h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'block-grid',
					'dataProvider'=> $model->getDataProvider('blocks'),
					'columns' => array(
						'link:raw:title',
						'label',
						'description',
//01698502806
					),
)); ?>