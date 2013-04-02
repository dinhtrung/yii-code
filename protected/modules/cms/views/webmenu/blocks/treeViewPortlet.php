<?php
/**
 * Render a menu portlet, using CTreeView
 * Configuration : $text : The menu title
 * $children: The menu items
 * @see Webmenu::getTreeMenuData
 */
if (empty($text) || empty($children) || empty($children)) return;
$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=> $text,
));
$this->widget('CTreeView', array(
	'collapsed'	=>	$expanded,
	'animated'	=>	'slow',
	'htmlOptions'=>array(
		'class'=>'treeview-famfamfam',
	),
	'data' => $children,
));

$this->endWidget();