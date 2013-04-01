<?php


$this->breadcrumbs=array(
	'Web Menus'=>array(Yii::t('core', 'index')),
	Yii::t('core', 'Manage'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Web Menus'));

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('web-menu-grid', {
					data: $(this).serialize()
				});
				return false;
				});
			");
		?>

<h1>
<?php echo $this->pageTitle = Yii::t('core', 'Manage') . ' ' . Yii::t('core', 'Web Menus'); ?>
</h1>

<?php echo CHtml::link(Yii::t('core', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'web-menu-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'label',
		'description:ntext',
		'url:ntext',
		array(
			'class'=>'EButtonColumn',
			'buttons'	=>	array(
				'sort' => array(
					'label'	=>	Yii::t('core', "Sort"),
					'url'	=>	'Yii::app()->controller->createUrl("sort",array("id"=>$data->primaryKey))',
					'imageUrl'	=> Yii::app()->baseUrl . "/images/icons/arrow-retweet.png",
				),
				'duplicate' => array(
					'label'	=>	Yii::t('core', "Duplicate"),
					'url'	=>	'Yii::app()->controller->createUrl("duplicate",array("id"=>$data->primaryKey))',
					'imageUrl'	=> Yii::app()->baseUrl . "/images/icons/blue-document-copy.png",
				),
			),
			'template'	=>	'{view} {update} {delete} {duplicate} {sort}',
		),
	),
));