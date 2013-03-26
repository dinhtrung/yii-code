<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms', 'Templates') => 'index',
	$model->title,
	Yii::t('isms', 'Update') ,
);
$this->renderPartial('_menu', array('model' => $model));
?>

<h1> <?php echo $this->pageTitle = Yii::t('isms', 'Update').' ' . Yii::t('isms', 'Template') . ' ' . CHtml::encode($model); ?> </h1>
<?php
$this->renderPartial('_form', array(
	'model' => $model
));
?>
