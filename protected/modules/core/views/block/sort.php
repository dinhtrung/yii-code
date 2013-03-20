<?php
if(empty($this->breadcrumbs))
$this->breadcrumbs = array(
	Yii::t('core', 'Blocks') => 'index',
	Yii::t('core', 'Sort'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Block'));
?>

<h1><?php echo $this->pageTitle = Yii::t('core', "Sort Blocks"); ?></h1>

<div id="message"></div>

<?php
$items = array();
foreach ($model as $block){
	$items[$block->region][$block->id] = Yii::t('core', '<strong>%title</strong>: %desc', array(
	    		'%title'	=>	$block->owner->title,
	    		'%desc'		=>	$block->owner->description,
	));
}
foreach ($items as $region => $listData){
	echo "<div class='view'>";
	echo "<h2>" . $region . "</h2>";
	$this->widget('zii.widgets.jui.CJuiSortable', array(
	        'id' 	=> $region . 'orderList',
	        'items' => $listData,
	));
	// Add a Submit button to send data to the controller
	echo CHtml::ajaxButton(Yii::t('core', 'Save'), '', array(
	        'type' => 'POST',
	        'data' => array(
	// Turn the Javascript array into a PHP-friendly string
	            'Order' => 'js:$("ul#'.$region.'orderList").sortable("toArray").toString()',
			),
	        'update'	=>	'#message',
	));
	echo "</div>";
}
?>