<?php


$this->breadcrumbs=array(
	Yii::t('core', 'Files')  =>	array('index'),
	Yii::t('core', 'Manage'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'File'));

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('file-grid', {
					data: $(this).serialize()
				});
				return false;
				});
			");
		?>

<h1>
<?php echo $this->pageTitle = Yii::t('core', 'Manage') . ' ' . Yii::t('core', 'Files'); ?> 
</h1>

<?php echo CHtml::link(Yii::t('core', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$locale = CLocale::getInstance(Yii::app()->language);

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'file-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'description',
		'name',
		'path',
		'parent_id',
		/*
		'version',
		'ext',
		'size',
		'type',
		'entity',
		'pkey',
		'createtime:datetime',
		'updatetime:datetime',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
