<?php

$this->breadcrumbs=array(
	'Blocktypes'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocktype'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('app', 'Create') . ' ' . Yii::t('blocktype', 'Blocktypes'); ?>
</h1>

<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

