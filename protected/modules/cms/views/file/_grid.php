<?php
$locale = CLocale::getInstance(Yii::app()->language);

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'file-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'type',
		'size:number',
		'createtime:datetime',
		'updatetime:datetime',
		/*
		'ext',
		'entity',
		array(
					'name'=>'pkey',
					'value'=>'CHtml::value($data,\'pkey0.title\')',
							'filter'=>CHtml::listData(Musiconhold::model()->findAll(), 'id', 'title'),
							),
		*/
	),
));
