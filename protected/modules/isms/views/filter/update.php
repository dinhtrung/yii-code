<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms', 'Filters') => array( 'index' ) ,
	CHtml::encode($model),
	Yii::t('isms', 'Update') ,
);
if (empty($this->menu))  $this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Update') .' ' .Yii::t('isms', 'Filter') .' '. $model->title; ?></h1>

<?php
$this->renderPartial('_form', array(
	'model' => $model
));
?>
