<?php


$this->breadcrumbs = array(
	'Blocktypes',
	Yii::t('app', 'Index'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocktype'));
?>

<h1>Blocktypes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
