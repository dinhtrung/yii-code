<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	Yii::t('ShopModule.shop', 'Manage'),
);

?>
<?php

$model = new Order();

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'order_id',
		'customer.address.firstname',
		'customer.address.lastname',
		'ordering_date:datetime',
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}',
		),

	),
)); ?>
