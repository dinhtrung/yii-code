<?php

$this->breadcrumbs=array(
	'Nodes'=>array(Yii::t('core', 'index')),
	Yii::t('core', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Node'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('core', 'Create') . ' ' . Yii::t('core', 'Nodes'); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

