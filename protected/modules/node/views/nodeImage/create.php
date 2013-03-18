<?php

$this->breadcrumbs=array(
	'Nodes'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Nodes'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('app', 'Create') . ' ' . Yii::t('Node', 'Nodes'); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

