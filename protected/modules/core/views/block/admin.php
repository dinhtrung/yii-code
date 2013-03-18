<?php


$this->breadcrumbs=array(
	'Blocks'	=>	array('index'),
	Yii::t('app', 'Manage'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocks'));

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('block-grid', {
					data: $(this).serialize()
				});
				return false;
				});
			");
		?>

<h1>
<?php echo $this->pageTitle = Yii::t('app', 'Manage') . ' ' . Yii::t('Block', 'Blocks'); ?>
</h1>

<?php echo CHtml::link(Yii::t('block', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$type = $model->getAttributeLabel('type');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'block-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'label',
		'description',
		"blocktype.link:raw:$type",
		array(
			'class'=>'EButtonColumnWithClearFilters',
			'buttons'	=>	array(
				'duplicate' => array(
					'label'	=>	Yii::t('app', "Duplicate"),
					'url'	=>	'Yii::app()->controller->createUrl("sort",array("id"=>$data->primaryKey))',
					'imageUrl'	=> Yii::app()->baseUrl . "/images/icons/blue-document-copy.png",
				),
				'configure'	=>	array(
 					'label'	=> 	Yii::t('app', 'Configure'),
     				'url'	=>	'Yii::app()->controller->createUrl("configure",array("id"=>$data->primaryKey))',
     				'imageUrl'	=>	Yii::app()->getBaseUrl() . '/images/icons/block--pencil.png',
				),
				'theme'	=>	array(
 					'label'	=> 	Yii::t('app', 'Theme'),
     				'url'	=>	'Yii::app()->controller->createUrl("theme",array("id"=>$data->primaryKey))',
     				'imageUrl'	=>	Yii::app()->getBaseUrl() . '/images/icons/block--arrow.png',
				),
			),
			'template'	=>	'{view} {update} {delete} {duplicate} {configure} {theme} ',
		),
	),
)); ?>
