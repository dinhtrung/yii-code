<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Smsorders')=>array('index'),
	Yii::t('app', 'Manage'),
);
$this->renderPartial('_menu', array('model' => $model));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('smsorder-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Manage SMS Orders'); ?></h1>
<blockquote> <p> <?php echo Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?> </p> </blockquote>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$btn = array();
if (Yii::app()->getUser()->checkAccess('Isms.Campaign.View')) $btn[] = '{view}';
if (Yii::app()->getUser()->checkAccess('Isms.Campaign.Update')) $btn[] = '{update}';
if (Yii::app()->getUser()->checkAccess('Isms.Campaign.Delete')) $btn[] = '{delete}';

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'smsorder-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
// 		'id',
		'title',
		'description',
		array('name' => 'user', 'value' => '$data->user->username', 'type' => 'raw'),
		array('name' => 'status', 'value' => 'Smsorder::statusOption($data->status)', 'type' => 'raw'),
		'expired',
 		'createtime:datetime',
// 		'updatetime:datetime',
		'smscount:number',
		'smsleft:number',
		/*
		'userid',
		*/
		array(
			'class'=>'EButtonColumnWithClearFilters',
			'template'	=>	implode(' ', $btn),
		),
	),
)); ?>
