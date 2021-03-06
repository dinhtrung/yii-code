<?php


$this->breadcrumbs=array(
	'Nodes'=>array(Yii::t('cms', 'index')),
	Yii::t('cms', 'Manage'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Node'));

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
<?php echo $this->pageTitle = Yii::t('cms', 'Manage') . ' ' . Yii::t('cms', 'Nodes'); ?>
</h1>

<?php echo CHtml::link(Yii::t('cms', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
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
		'description:ntext',
		'status:boolean',
		'createtime:datetime',
		array(
			'class'=>'EButtonColumn',
		),
	),
)); ?>

<?php echo CHtml::link("Export PDF", array("admin", "view" => "pdf"))?>
