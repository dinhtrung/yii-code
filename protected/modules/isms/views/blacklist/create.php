<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms','Blacklists') => array(
		Yii::t('isms', 'index')
	) ,
	Yii::t('isms', 'Create') ,
);
if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blacklist'));
?>

<h1><?php echo $this->pageTitle = Yii::t('isms', 'Create') . ' ' . Yii::t('isms', 'Blacklists'); ?></h1>
<?php
$this->renderPartial('_form', array(
	'model' => $model,
));
?>

