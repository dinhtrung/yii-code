<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs = array(
	'Trees',
	Yii::t('app', 'Index'),
);

if(empty($this->menu))
$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Tree', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Tree', 'url'=>array('admin')),
);
?>

<h1>Trees</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
