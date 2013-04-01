<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('cms', 'Tags')=>array('index'),
	Yii::t('cms', 'Manage'),
);


		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('tags-grid', {
					data: $(this).serialize()
				});
				return false;
				});
			");
		?>

<h1> <?php echo Yii::t('cms', 'Manage'); ?> Tags</h1>

<?php echo CHtml::link(Yii::t('cms', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$locale = CLocale::getInstance(Yii::app()->language);

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tags-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'frequency:number',
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
