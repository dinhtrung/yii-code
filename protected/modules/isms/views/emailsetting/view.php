<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('isms', 'Emailsettings')	=>	array('index'),
	CHtml::encode($model),
	);

if(empty($this->menu)) $this->renderPartial('_menu', array('model' => $model));

?>

<h1><?php echo $this->pageTitle = Yii::t('isms', 'View') . ' ' . Yii::t('isms', 'Emailsetting') .' ' .$model; ?></h1>

<?php
 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'hostname',
		'email',
		array('name' => 'email', 'value' => $model->getUsername()),
		'password',
		'option',
		array(
			'name' => 'status',
			'value'	=>	$model->getStatus(),
			'type'	=>	'boolean'
		),
	))); ?>
