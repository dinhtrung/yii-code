<?php

$this->breadcrumbs=array(
	'Web Menus'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Web Menus'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('app', 'Create') . ' ' . Yii::t('Webmenu', 'Web Menus'); ?> 
</h1>

<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

