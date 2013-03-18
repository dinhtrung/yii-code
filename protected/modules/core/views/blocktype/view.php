<?php


$this->breadcrumbs=array(
'Blocktypes'=>array('index'),
	$model->title,
	);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocktype', 'primaryKey' => 'btid'));
?>

<h1>
<?php echo $this->pageTitle = Yii::t('app', 'View') . ' ' . Yii::t('blocktype', 'Blocktypes  :name', array(':name' => CHtml::encode($model))); ?>
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



<h2><?php echo CHtml::link(Yii::t('blocktype', 'Blocks of type :title', array(':title'	=>	$model->title)), array('/core/block'));?></h2>
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