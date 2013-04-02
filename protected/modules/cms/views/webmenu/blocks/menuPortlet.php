<?php
/**
 * Render a menu portlet.
 * Configuration : $title : The menu title
 * $items: The menu items
 * @see Webmenu::getMenuData
 */
 if (empty($title)) return;
 if (empty($items)) return;
 
$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=> $title,
));
$this->widget('zii.widgets.CMenu', array(
	'items'=>$items,
	'htmlOptions'=>array('class'=>'operations'),
));
$this->endWidget();
?>