<?php $this->breadcrumbs=array(
	Yii::t('user', "Users"),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('user', "List User"); ?></h1>


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
		),
		'createtime:datetime',
		'updatetime:datetime',
	),
)); ?>
