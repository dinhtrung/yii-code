<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
'Web Menus'=>array('index'),
	$model->label,
	);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Web Menus', 'primaryKey' => 'id'));
?>

<h1><?php echo $this->pageTitle = Yii::t('core', 'View Webmenu :item', array(':item' => CHtml::encode($model))); ?></h1>

<?php
$model->url = (strpos($model->url, '://') || ($model->url && ($model->url[0] == '#')))?$model->url:$this->createAbsoluteUrl($model->url);
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'label',
		'description',
		'url:url',
		'template',
		'visible:boolean',
		array(
			'name'	=>	'icon',
			'value'	=>	$model->Image->getFileUrl(),
			'type'	=>	'image',
		)
	),
));

?>

<h2><?php echo Yii::t('core', "Ancestors of Webmenu :item", array(':item' => CHtml::encode($model)))?></h2>

<?php foreach ($model->ancestors()->findAll() as $data) $this->renderPartial("_view", array('data' => $data)); ?>

<h2><?php echo Yii::t('core', "Decendances of Webmenu :item", array(':item' => CHtml::encode($model)))?></h2>

<?php foreach ($model->children()->findAll() as $data) $this->renderPartial("_view", array('data' => $data)); ?>