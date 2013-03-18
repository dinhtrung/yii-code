<?php

$this->breadcrumbs=array(
	'Comments'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Comments'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('app', 'Create') . ' ' . Yii::t('Comments', 'Comments'); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

