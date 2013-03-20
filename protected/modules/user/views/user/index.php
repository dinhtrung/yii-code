<?php $this->breadcrumbs=array(
	Yii::t('user', "Users"),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('user', "List User"); ?></h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
		),
		'createtime:datetime',
		array(
			'name' => 'lastvisit',
			'value' => '(($data->lastvisit)?date("d.m.Y H:i:s",$data->lastvisit):Yii::t('user', "Not visited"))',
		),
	),
)); ?>
