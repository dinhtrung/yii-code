<?php
/**
 * Render a menu portlet.
 * Configuration : $title : The menu title
 * $items: The menu items
 * @see Webmenu::getMenuData
 */
 if (empty($root)) return;
 if (empty($items)) return;
foreach ($items as $idx => $item){
	$items[$idx] = array(
		'src'		=>	$item->Image->getFileUrl(),
		'caption'	=>	$item->label,
		'url'		=>	(strpos($item->url, '://') || ($item->url && ($item->url[0] == '#')))?$item->url:array($item->url),
		'linkOptions' => array(),
	);
}
$this->widget('ext.widgets.nivoslider.ENivoSlider', array(
	'id'	=>	'slider' . $root->id,
	'images'=> $items,
));
