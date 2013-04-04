<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	'Filters' => array(
		Yii::t('isms', 'index')
	) ,
	Yii::t('isms', 'Create') ,
);
if(empty($this->menu)) $this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create') . ' ' . Yii::t('isms', 'Filter'); ?></h1>
<?php
$this->renderPartial('_form', array('model' => $model));
?>

