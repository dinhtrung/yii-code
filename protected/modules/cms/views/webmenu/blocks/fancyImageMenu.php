<?php
/**
 * Render image links with fancybox support
 */
if (empty($items)) return;
foreach ($items as $data){
	echo CHtml::link(
		CHtml::image($data->Image->getFileUrl(), $data->label, array('title' => $data->label)),
		(($data->url && ! strpos($data->url, '://') && !($data->url[0] == '#'))?array($data->url):$data->url)
	);
}
$fancybox = array(
	'selector'=>'a[href$=\'.jpg\'],a[href$=\'.png\'],a[href$=\'.gif\']',
	'enableMouseWheel'	=>	true,
	'options'=>array(
		'padding'=>10,
		'margin'=>20,
		'enableEscapeButton'=>true,
),
);
$this->widget('ext.yiiext.widgets.fancybox.EFancyboxWidget', $fancybox);
