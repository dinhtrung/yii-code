<?php
if(!isset($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('isms', 'Whitelists')	=>	array(Yii::t('app', 'index')),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Whitelist', 'primaryKey' => 'id'));
?>

<h1><?php echo $this->pageTitle = Yii::t('isms', 'Update') . ' ' . Yii::t('isms', 'Whitelists'); ?> <?php echo $model; ?> </h1>
<?php
$this->renderPartial('_form', array(
	'model' => $model
));
?>
