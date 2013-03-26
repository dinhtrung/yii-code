<?php
if(empty($this->breadcrumbs))
$this->breadcrumbs=array(
	'Ftpsettings'=>array(Yii::t('isms', 'index')),
	Yii::t('isms', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Ftpsetting'));
?>

<h1> <?php echo $this->pageTitle = Yii::t('app', 'Create').' '.Yii::t('isms', 'Ftpsettings'); ?></h1>
<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

