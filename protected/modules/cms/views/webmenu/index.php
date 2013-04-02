<?php


$this->breadcrumbs = array(
	'Web Menus',
	Yii::t('core', 'Index'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Web Menus'));
?>

<h1>Web Menus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
