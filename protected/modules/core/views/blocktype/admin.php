<?php


$this->breadcrumbs=array(
	'Blocktypes'=>array(Yii::t('core', 'index')),
	Yii::t('core', 'Manage'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocktype'));

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('blocktype-grid', {
					data: $(this).serialize()
				});
				return false;
				});
			");
		?>

<h1>
<?php echo $this->pageTitle = Yii::t('core', 'Manage') . ' ' . Yii::t('core', 'Blocktypes'); ?>
</h1>

<?php echo CHtml::link(Yii::t('core', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'blocktype-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'description',
		array(
			'class'=>'EButtonColumnWithClearFilters',
			'buttons'	=>	array(
				'duplicate' => array(
					'label'	=>	Yii::t('core', "Duplicate"),
					'url'	=>	'Yii::app()->controller->createUrl("sort",array("id"=>$data->primaryKey))',
					'imageUrl'	=> Yii::app()->baseUrl . "/images/icons/blue-document-copy.png",
				),
			),
			'template'	=>	'{view} {update} {delete} {duplicate}',
		),
	),
));

$types = array('CSV', 'Excel5', 'Excel2007', 'HTML', 'PDF');
foreach ($types as $type){
	echo CHtml::link(
		Yii::t('core', 'Export :type', array(':type' => $type)),
		array('', 'view' => 'excel', 'exportType' => $type),
		array('style' => 'padding: 5px 10px;')
	);
}
?>
