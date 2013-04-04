<?php
if(!isset($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('isms', 'Blacklists')	=>	array(Yii::t('app', 'index')),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blacklist', 'primaryKey' => 'id'));
?>

<h1><?php echo $this->pageTitle = Yii::t('isms', 'Update') . ' ' . Yii::t('isms', 'Blacklists'); ?> <?php echo $model; ?> </h1>
<?php
$this->renderPartial('_form', array(
	'model' => $model
));
?>
