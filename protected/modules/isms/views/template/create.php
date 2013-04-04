<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms', 'Templates') => 'index',
	Yii::t('isms', 'Create') ,
);
$this->renderPartial('_menu', array('model' => $model));
?>

<h1> <?php echo $this->pageTitle = Yii::t('isms', 'Create').' ' . Yii::t('isms', 'Template') ; ?> </h1>
<?php
$this->renderPartial('_form', array(
	'model' => $model,
	'buttons' => 'create'
));
?>

