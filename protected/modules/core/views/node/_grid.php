<?php
$locale = CLocale::getInstance(Yii::app()->language);

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'node-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'body',
		/*
		'createtime:datetime',,
		'updatetime:datetime',,
		'uid',
		'category',
		'tags',
		*/
	),
));
