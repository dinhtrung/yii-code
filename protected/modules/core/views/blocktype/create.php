<?php

$this->breadcrumbs=array(
	'Blocktypes'=>array(Yii::t('core', 'index')),
	Yii::t('core', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocktype'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('core', 'Create') . ' ' . Yii::t('core', 'Blocktypes'); ?>
</h1>

<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

