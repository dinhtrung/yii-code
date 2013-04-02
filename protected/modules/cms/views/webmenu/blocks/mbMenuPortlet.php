<?php
/**
 * Render a menu portlet.
 * Configuration : $title : The menu title
 * $items: The menu items
 * @see Webmenu::getMenuData
 */
 if (empty($title)) return;
 if (empty($items)) return;
$this->widget('ext.widgets.mbmenu.MbMenu',array(
      			'items'=> $items,
));
