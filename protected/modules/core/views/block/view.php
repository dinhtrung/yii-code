<?php
$this->breadcrumbs=array(
	Yii::t('core', 'Blocks')	=>	'index',
	$model->title,
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocks', 'primaryKey' => 'bid'));
?>

<h1>
<?php echo $this->pageTitle = Yii::t('core', 'View') . ' ' . Yii::t('core', 'Blocks :name', array(':name' => CHtml::encode($model->title))); ?>
</h1>

<div>
<?php $this->beginWidget("CMarkdown");
echo $model->description;
$this->endWidget(); ?>

</div>

<?php
$type = $model->getAttributeLabel('type');
$urls = explode("\n", $model->url);
foreach ($urls as $idx => $url){
	$urls[$idx] = CHtml::link($url, array($url));
}
$urls = "<ul><li>" . implode("</li><li>", $urls) . "</li></ul>";
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'label',
		"blocktype.link:raw:$type",
		'status:boolean',
		array(
			'name'	=>	'display',
			'value'	=>	Block::displayOption($model->display),
		),
		array(
			'name'	=>	'url',
			'value'	=>	$urls,
			'type'	=>	'raw'
		),
	),
));
?>



<h2><?php echo Yii::t('core', "Usage")?></h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'blocktheme-grid',
					'dataProvider'=> $model->getDataProvider('themes'),
					'columns' => array(
						'theme',
						'region',
					),
				)); ?>

<h2><?php echo Yii::t('core', "Block Preview") ?></h2>

<div>
<?php
	print $model->render();
?>
</div>