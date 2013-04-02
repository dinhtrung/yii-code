<?php $this->breadcrumbs=array(
	Yii::t('user', 'Users')=>array('index'),
	$model->username,
);
?>
<h1><?php echo $this->pageTitle = Yii::t('user', 'View User').' "'.$model->username.'"'; ?></h1>

<?php
	$attributes = array(
			'username',
			'createtime:datetime',
			'updatetime:datetime',
	);

	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));

?>
