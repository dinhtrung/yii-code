<?php
/* @var $this ProjectsController */
/* @var $data Projects */
?>

<div class="view">
	<h3><?php echo $data->getLink(); ?></h3>

	<p class="box"><?php echo CHtml::encode($data->description); ?></p>

<?php

$data->priority  = $this->widget("CStarRating",array("model" => $data, "attribute" => 'priority', 'starCount'	=> 5, "readOnly" => TRUE), TRUE);
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$data,
	'attributes'=>array(
		'priority:raw',
		'alias',
		'target_budget:number',
		'actual_budget:number',
		'start_date',
		'end_date',
		'priority:html',
		'private:boolean',
		'status:boolean',
		'percent_complete',
		'department',
		'url',
		'demo_url',
		'au.link:html:author',
		'ed.link:html:editor',
		'ow.link:html:owner',
		'createtime:datetime',
		'updatetime:datetime',
	),
)); ?>
</div>