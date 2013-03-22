<?php
$this->breadcrumbs=array(
	Yii::t('ShopModule.shop', 'Customers')=>array('index'),
	Yii::t('ShopModule.shop', 'Manage'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-grid', {
		url: $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");
?>

	<h1><?php echo Yii::t('ShopModule.shop', 'Admin Customers'); ?></h1>

<?php echo CHtml::link(Yii::t('ShopModule.shop', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
$columns = array();
foreach ($model->relations() as $attr => $related){
	if ($related[0] == CActiveRecord::BELONGS_TO) $columns[] = $attr;
}
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'	=>	$columns,
)); ?>
