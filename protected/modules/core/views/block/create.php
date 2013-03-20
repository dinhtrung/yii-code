<?php

$this->breadcrumbs=array(
	Yii::t('core', 'Blocks')	=> 'index',
	Yii::t('core', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocks'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('core', 'Create') . ' ' . Yii::t('core', 'Block'); ?>
</h1>

<?php
$this->renderPartial('_form', array( 'model' => $model));

?>

