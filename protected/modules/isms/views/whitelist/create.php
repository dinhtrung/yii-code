<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms','Whitelists') => array(
		Yii::t('isms', 'index')
	) ,
	Yii::t('isms', 'Create') ,
);
if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Whitelist'));
?>

<h1><?php echo $this->pageTitle = Yii::t('isms', 'Create') . ' ' . Yii::t('isms', 'Whitelists'); ?></h1>
<?php
$this->renderPartial('_form', array(
	'model' => $model,
));
?>

