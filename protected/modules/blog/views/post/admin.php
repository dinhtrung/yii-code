<?php
$this->breadcrumbs=array(
	'Manage Posts',
);
?>
<h1><?php echo $this->pageTitle = Yii::t('blog', "Manage Posts"); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'title',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->title), $data->url)'
		),
		array(
			'name'=>'status',
			'value'=>'Post::statusOptions($data->status)',
			'filter'=>Post::statusOptions(),
		),
		array(
			'name'=>'create_time',
			'type'=>'datetime',
			'filter'=>false,
		),
		array(
			'class'=>'EButtonColumn',
		),
	),
)); ?>
