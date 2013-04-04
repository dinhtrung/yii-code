<?php
if(!isset($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('campaign', 'Campaigns')	=>	array('index'),
	Yii::t('app', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Campaign'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('app', 'Create') . ' ' . Yii::t('campaign', 'Campaigns'); ?>
</h1>

<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

