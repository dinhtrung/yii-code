<?php


$this->breadcrumbs=array(
	Yii::t('cms', 'Categories') => array('index'),
	Yii::t('cms', 'Manage'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Categories'));

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('category-grid', {
					data: $(this).serialize()
				});
				return false;
				});
			");
		?>

<h1>
<?php echo $this->pageTitle = Yii::t('cms', 'Manage') . ' ' . Yii::t('cms', 'Categories'); ?>
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
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'description',
		array(
			'class'=>'EButtonColumn',
			'buttons'	=>	array(
				'sort' => array(
					'label'	=>	Yii::t('cms', "Sort"),
					'url'	=>	'Yii::app()->controller->createUrl("sort",array("id"=>$data->primaryKey))',
					'imageUrl'	=> Yii::app()->baseUrl . "/images/icons/arrow-retweet.png",
				),
				'duplicate' => array(
					'label'	=>	Yii::t('cms', "Duplicate"),
					'url'	=>	'Yii::app()->controller->createUrl("sort",array("id"=>$data->primaryKey))',
					'imageUrl'	=> Yii::app()->baseUrl . "/images/icons/blue-document-copy.png",
				),
			),
			'template'	=>	'{view} {update} {delete} {duplicate} {sort}',
		),
	),
)); ?>
