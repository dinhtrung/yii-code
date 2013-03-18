<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Users')=>array('admin'),
	$model->username,
);
?>
<h1><?php echo $this->pageTitle = Yii::t('user', 'View User').' "'.$model->username.'"'; ?></h1>

<?php echo $this->renderPartial('_menu', array(
		'list'=> array(
			CHtml::link(Yii::t('user', 'Create User'),array('create')),
			CHtml::link(Yii::t('user', 'Update User'),array('update','id'=>$model->id)),
			CHtml::linkButton(Yii::t('user', 'Delete User'),array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('user', 'Are you sure to delete this item?'))),
		),
	));


	$attributes = array(
		'username',
	);

	$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => Yii::t('user', $field->title),
					'name' => $field->varname,
					'type'=>'raw',
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),
				));
		}
	}

	array_push($attributes,
		'password',
		'email:email',
		'activkey',
		'createtime:datetime',
		'lastvisit:datetime',
		array(
			'name' => 'superuser',
			'value' => User::itemAlias("AdminStatus",$model->superuser),
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
