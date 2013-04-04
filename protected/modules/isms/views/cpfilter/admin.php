<?php
$this->breadcrumbs=array(
	Yii::t('app', 'CampaignFilter')	=>	array(Yii::t('app', 'index')),
);

$this->renderPartial('_menu');

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('campaign-filter-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
		?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Manage'). " ".Yii::t('app', 'CampaignFilter'); ?></h1>
<blockquote> <p> <?php echo Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?> </p> </blockquote>
<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$btn = array();
if (Yii::app()->getUser()->checkAccess('CampaignFilter.View')) $btn[] = '{view}';
if (Yii::app()->getUser()->checkAccess('CampaignFilter.Update')) $btn[] = '{update}';
if (Yii::app()->getUser()->checkAccess('CampaignFilter.Delete')) $btn[] = '{delete}';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'campaign-filter-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name' => 'cid', 'value' => '$data->c', 'type' => 'text'),
		array('name' => 'fid', 'value' => '$data->f', 'type' => 'text'),
		array('name' => 'type', 'value' => 'CampaignFilter::typeOption($data->type)', 'type' => 'text'),
		array(
			'class'=>'EButtonColumnWithClearFilters',
			'viewButtonUrl' => 'Yii::app()->controller->createUrl("view",$data->primaryKey)',
			'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",$data->primaryKey)',
			'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",$data->primaryKey)',
			'template' => implode(' ', $btn),
		),
	),
)); ?>
