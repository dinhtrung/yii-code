<?php
$this->breadcrumbs=array(
	Yii::t('isms', 'Datafile') =>	'index',
	Yii::t('app', 'Create'),
);

$this->renderPartial('_menu');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create') ." ". Yii::t('isms', 'Datafile'); ?></h1>
<?php $this->renderPartial('_form', array('model' => $model)); ?>