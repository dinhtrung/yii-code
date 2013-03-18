<?php

$this->breadcrumbs=array(
	'Blocks'=>array(Yii::t('block', 'index')),
	Yii::t('app', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocks'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('app', 'Create') . ' ' . Yii::t('block', 'Block'); ?>
</h1>

<?php
$this->renderPartial('_form', array( 'model' => $model));

?>

