<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms', 'Filters') => array('index'),
	Yii::t('isms', 'Manage') ,
);
if(empty($this->menu)) $this->renderPartial('_menu', array('model' => $model));
Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('filter-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
?>

<h1> <?php echo $this->pageTitle = Yii::t('app', 'Manage') . ' ' . Yii::t('isms', 'Filters'); ?></h1>

<?php echo CHtml::link(Yii::t('isms', 'Advanced Search') , '#', array(
	'class' => 'search-button'
)); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div>

<?php
$btn = array();
if (Yii::app()->getUser()->checkAccess('Isms.Filter.View')) $btn[] = '{view}'; 
if (Yii::app()->getUser()->checkAccess('Isms.Filter.Update')) $btn[] = '{update}'; 
if (Yii::app()->getUser()->checkAccess('Isms.Filter.Delete')) $btn[] = '{delete}'; 
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'filter-grid',
	'dataProvider' => $model->search() ,
	'filter' => $model,
	'columns' => array(
		'title',
		'reply_refuse',
		'reply_accept',
		'reply_false_syntax',
		'description',
		/*
		'accept_count',
		'refuse_count',
		*/
		array(
			'class' => 'EButtonColumnWithClearFilters',
			'template' => implode(' ', $btn),
		) ,
	) ,
));
echo CHtml::endForm();
