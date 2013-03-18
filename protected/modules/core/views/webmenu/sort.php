<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs = array(
	Yii::t('webmenu', 'Web Menu') => array('index'),
	Yii::t('webmenu', 'Sort'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Web Menus', 'primaryKey' => 'id'));
?>
<h1><?php echo $this->pageTitle = Yii::t('webmenu', 'Sort Web Menu :title', array('title' => $model->label)); ?></h1>

<div id="message"></div>
<?php
    // Organize the dataProvider data into a Zii-friendly array
    $items = array();
    foreach ($model->children()->findAll() as $k => $v) {
    	$items[$v->id] = Yii::t('webmenu', '<strong>%title</strong>: %desc', array(
    		'%title'	=>	$v->label,
    		'%desc'		=>	$v->description,
    	));
    }
    // Implement the JUI Sortable plugin
    $this->widget('zii.widgets.jui.CJuiSortable', array(
        'id' => 'orderList',
        'items' => $items,
    ));
    // Add a Submit button to send data to the controller
    echo CHtml::ajaxButton(Yii::t('app', 'Save'), '', array(
        'type' => 'POST',
        'data' => array(
            'Order' => 'js:$("ul#orderList").sortable("toArray").toString()',
        ),
        'update'	=>	'#message',

    ));
?>