<?php


$this->breadcrumbs = array(
	'Blocks',
	Yii::t('core', 'Index'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocks'));
?>

<h1>Blocks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
