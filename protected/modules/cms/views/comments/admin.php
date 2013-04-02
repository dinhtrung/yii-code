<?php


$this->breadcrumbs=array(
	'Comments'=>array(Yii::t('cms', 'index')),
	Yii::t('cms', 'Manage'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Comments'));

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('comments-grid', {
					data: $(this).serialize()
				});
				return false;
				});
			");
		?>

<h1>
<?php echo $this->pageTitle = Yii::t('cms', 'Manage') . ' ' . Yii::t('cms', 'Comments'); ?>
</h1>

<?php echo CHtml::link(Yii::t('cms', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$this->widget( 'ext.widgets.ajaxcrud.EUpdateDialog');
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comments-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'comment',
		'visible:boolean',
		'createtime:datetime',
		array(
			'class'=>'CButtonColumn',
 			'deleteButtonUrl' => 'Yii::app()->createUrl("comments/delete", array( "id" => $data->primaryKey))',
       		'buttons' => array(
         		'delete' => array(
           			'click' => 'updateDialogDelete',
 				),
         		'update' => array(
           			'click' => 'updateDialogUpdate',
 				),
 			),
		),
	),
)); ?>
