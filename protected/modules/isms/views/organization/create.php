<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	'Organizations' => array(
		Yii::t('isms', 'index')
	) ,
	Yii::t('isms', 'Create') ,
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
);
?>

<h1> Tạo Organization </h1>
<?php
$this->renderPartial('_form', array(
	'model' => $model,
	'buttons' => 'create'
));
?>

