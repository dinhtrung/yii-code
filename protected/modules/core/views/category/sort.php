<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs = array(
	Yii::t('category', 'Categories') =>array('index'),
	Yii::t('category', 'Sort') =>array('sort', 'id' => $model->id),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Category', 'primaryKey' => 'id'));
?>
<h1><?php echo $this->pageTitle = Yii::t('category', 'Sort Category :title', array('title' => $model->title)); ?></h1>

<div id="message"></div>
<?php
    // Organize the dataProvider data into a Zii-friendly array
    $items = array();
    foreach ($model->children()->findAll() as $k => $v) {
    	$items[$v->id] = Yii::t('category', '<strong>%title</strong>: %desc', array(
    		'%title'	=>	$v->title,
    		'%desc'		=>	$v->description,
    	));
    }
    // Implement the JUI Sortable plugin
    $this->widget('zii.widgets.jui.CJuiSortable', array(
        'id' => 'orderList',
        'items' => $items,
    ));
    // Add a Submit button to send data to the controller
    echo CHtml::ajaxButton(Yii::t('app', 'Submit Changes'), '', array(
        'type' => 'POST',
        'data' => array(
            // Turn the Javascript array into a PHP-friendly string
            'Order' => 'js:$("ul#orderList").sortable("toArray").toString()',
        ),
        'update'	=>	'#message',

    ));
?>