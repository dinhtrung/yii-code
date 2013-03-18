<?php


$this->breadcrumbs=array(
	'Nodes'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Manage'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Nodes'));

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('node-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
		?>

<h1>
<?php echo $this->pageTitle = Yii::t('app', 'Manage') . ' ' . Yii::t('Node', 'Nodes'); ?>
</h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$locale = CLocale::getInstance(Yii::app()->language);

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'node-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'description:raw',
		'createtime:datetime',
		/*
		'body',
		'alias',
		'id',
		'updatetime:datetime',,
		'uid',
		'cid',
		'tags',
		'type',
		array(
					'name'=>'status',
					'value'=>'$data->status?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\', \'No\')',
							'filter'=>array('0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')),
							),
		*/
		array(
			'class'=>'EButtonColumnWithClearFilters',
		),
	),
)); ?>

<?php echo CHtml::link("Export PDF", array("admin", "view" => "pdf"))?>
