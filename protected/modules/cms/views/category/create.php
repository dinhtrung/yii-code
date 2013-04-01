<?php

$this->breadcrumbs=array(
	Yii::t('cms', 'Categories') => array('index'),
	Yii::t('cms', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Categories'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('cms', 'Create') . ' ' . Yii::t('cms', 'Categories'); ?>
</h1>

<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

