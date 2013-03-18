<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	'Trees'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Manage'),
);

if(empty($this->menu))
$this->menu=array(
		array('label'=>Yii::t('app', 'List') . ' Tree',
			'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' Tree',
		'url'=>array('create')),
	);

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('tree-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
		?>

<h1> <?php echo Yii::t('app', 'Manage'); ?> Trees</h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$locale = CLocale::getInstance(Yii::app()->language);

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tree-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'description',
		/*
		'id',
		'root',
		'lft',
		'rgt',
		'level',
		*/
		array(
			'class'=>'EButtonColumnWithClearFilters',
			'updateButtonImageUrl'	=>	Yii::app()->baseUrl . "/images/icons/update.png",
			'deleteButtonImageUrl'	=>	Yii::app()->baseUrl . "/images/icons/delete.png",
			'viewButtonImageUrl'	=>	Yii::app()->baseUrl . "/images/icons/view.png",
			'template'	=>	'{view} {update} {delete}',
		),
	),
));

echo CHtml::endForm();
