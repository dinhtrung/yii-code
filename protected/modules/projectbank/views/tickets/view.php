<?php
$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Tickets','url'=>array('index')),
	array('label'=>'Create Tickets','url'=>array('create')),
	array('label'=>'Update Tickets','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Tickets','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tickets','url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = $model->title; ?></h1>

<?php $this->beginWidget('CMarkdown'); ?><?php echo CHtml::encode($model->body); ?><?php $this->endWidget(); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'tickets-reply')); ?>
	<div class="modal-header">
	    <a class="close" data-dismiss="modal">&times;</a>
	    <h4><?php echo Yii::t("projectbank", "Post A Reply")?></h4>
	</div>
	<?php $this->renderPartial("_childForm", array("model" => $child)); ?>
 
<?php $this->endWidget(); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('projectbank', 'New Message'),
    'type'=>'primary',
    'htmlOptions'=>array(
        'data-toggle'=>'modal',
        'data-target'=>'#tickets-reply',
    ),
)); ?>


<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'createtime:datetime',
		'updatetime:datetime',
		'user:html',
		'project:html',
	),
)); ?>

<div class="children offset1">
	<?php $this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider'=>new CActiveDataProvider($model->children()),
		'itemView'=>'_view',
	)); ?>
</div>