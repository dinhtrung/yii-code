<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs = array(
	'Tags',
	Yii::t('app', 'Index'),
);

if(empty($this->menu))
$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Tags', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Tags', 'url'=>array('admin')),
);
?>

<h1>Tags</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
