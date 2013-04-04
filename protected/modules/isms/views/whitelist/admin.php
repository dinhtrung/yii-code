<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms', 'Whitelists') => array(
		Yii::t('isms', 'index')
	) ,
	Yii::t('isms', 'Manage') ,
);
if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Whitelist'));

Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('Whitelist-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
?>

<h1><?php echo $this->pageTitle = Yii::t('isms', 'Manage') . ' ' . Yii::t('isms', 'Whitelists'); ?></h1>

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
if (Yii::app()->getUser()->checkAccess('Isms.Whitelist.View')) $btn[] = '{view}'; 
if (Yii::app()->getUser()->checkAccess('Isms.Whitelist.Update')) $btn[] = '{update}'; 
if (Yii::app()->getUser()->checkAccess('Isms.Whitelist.Delete')) $btn[] = '{delete}'; 

$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'Whitelist-grid',
	'dataProvider' => $model->search() ,
	'filter' => $model,
	'columns' => array(
		array(
			'name' => 'fid',
			'value' => 'CHtml::value($data,\'f.title\')',
			'filter' => CHtml::listData(Filter::model()->findAll() , 'id', 'title') ,
		) ,
		'isdn',
		array(
			'class' => 'EButtonColumnWithClearFilters',
			'template'	=>	implode(' ', $btn),
		) ,
	) ,
));
echo CHtml::endForm();
