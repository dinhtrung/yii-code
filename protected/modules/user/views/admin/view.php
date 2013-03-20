<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Users')=>array('admin'),
	$model->username,
);
?>
<h1><?php echo $this->pageTitle = Yii::t('user', 'View User').' "'.$model->username.'"'; ?></h1>

<?php echo $this->renderPartial('_menu');


	$attributes = array(
		'username',
		'email',
		'activkey',
		'createtime:datetime',
		'lastvisit:datetime',
		array(
			'name' => 'role',
			'value' => Yii::t('rights', implode(', ', $model->role), array(), 'dbmessages'),
		),
		array(
			'name' => 'status',
			'value' => User::itemAlias("UserStatus",$model->status),
		)
	);

	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));


?>
