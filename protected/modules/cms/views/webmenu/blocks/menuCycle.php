<?php
/**
 * Render the most recent updated products
 */
if (empty($items)) return;
$this->beginWidget('ext.yiiext.widgets.cycle.ECycleWidget');
$first = $items[0]; unset($items[0]);
echo CHtml::image($first->Image->getFileUrl(), $first->label, array('title' => $first->label));

foreach ($items as $cnt => $data){
	echo CHtml::image($data->Image->getFileUrl(), $data->label, array('title' => $data->label, 'style' => 'display:none;'));
}
$this->endWidget();
