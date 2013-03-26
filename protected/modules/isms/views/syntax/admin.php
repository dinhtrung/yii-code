<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Syntax')	=>	array(Yii::t('app', 'index')),
);

$this->renderPartial('_menu');

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('syntax-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
		?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Manage'). " ".Yii::t('app', 'Syntax'); ?></h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$btn = array();
if (Yii::app()->getUser()->checkAccess('Syntax.View')) $btn[] = '{view}';
if (Yii::app()->getUser()->checkAccess('Syntax.Update')) $btn[] = '{update}';
if (Yii::app()->getUser()->checkAccess('Syntax.Delete')) $btn[] = '{delete}';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'syntax-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
					'filter',
					'syntax',
					array('name' => 'type', 'value' => 'Syntax::typeOption($data->type)', 'filter' => Syntax::typeOption()),
		array(
			'class'=>'EButtonColumnWithClearFilters',
						'viewButtonUrl' => 'Yii::app()->controller->createUrl("view",$data->primaryKey)',
			'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",$data->primaryKey)',
			'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",$data->primaryKey)',
						'template' => implode(' ', $btn),
		),
	),
)); ?>
