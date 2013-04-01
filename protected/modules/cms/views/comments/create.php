<?php

$this->breadcrumbs=array(
	'Comments'=>array(Yii::t('cms', 'index')),
	Yii::t('cms', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Comments'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('cms', 'Create') . ' ' . Yii::t('cms', 'Comments'); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

