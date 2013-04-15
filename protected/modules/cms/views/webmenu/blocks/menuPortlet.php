<?php
/**
 * Render a menu portlet.
 * Configuration : $title : The menu title
 * $items: The menu items
 * @see Webmenu::getMenuData
 */
 if (empty($title)) return;
 if (empty($items)) return;

 CVarDumper::dump($items, 10, TRUE);

$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=> $title,
));
	$this->widget('zii.widgets.CMenu', array(
		'items'=>$items,
	));
$this->endWidget();
?>