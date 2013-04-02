<?php

$this->breadcrumbs=array(
	Yii::t('cms', 'Nodes')	=>'index',
	Yii::t('cms', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Node'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('cms', 'Create') . ' ' . Yii::t('cms', 'Nodes'); ?>
</h1>

<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

