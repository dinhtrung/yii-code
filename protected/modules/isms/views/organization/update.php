<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	'Organizations' => array(
		'index'
	) ,
	$model->title => array(
		'view',
		'id' => $model->id
	) ,
	Yii::t('isms', 'Update') ,
);
if (empty($this->menu)) $this->menu = array(
	array(
		'label' => Yii::t('isms', 'List') . ' Organization',
		'url' => array(
			'index'
		)
	) ,
	array(
		'label' => Yii::t('isms', 'Create') . ' Organization',
		'url' => array(
			'create'
		)
	) ,
	array(
		'label' => Yii::t('isms', 'View') . ' Organization',
		'url' => array(
			'view',
			'id' => $model->id
		)
	) ,
	array(
		'label' => Yii::t('isms', 'Manage') . ' Organization',
		'url' => array(
			'admin'
		)
	) ,
);
?>

<h1> <?php echo Yii::t('isms', 'Update'); ?> Organization #<?php echo $model; ?> </h1>
<?php
$this->renderPartial('_form', array(
	'model' => $model
));
?>
