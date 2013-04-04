<?php
$current = Yii::app()->getController()->getAction()->getId();
$this->menu['admin'] = array(
	'label'		=>	Yii::t('app', 'Manage'). ' ' . Yii::t('isms', 'Emailsetting'),
	'url'		=>	array('index'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Emailsetting.Index'),
	'active'	=>	($current == 'index'),
);
$this->menu['create'] = array(
	'label'		=>	Yii::t('app', 'Create'). ' ' . Yii::t('isms', 'Emailsetting'),
	'url'		=>	array('create'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Emailsetting.Create'),
	'active'	=>	($current == 'create'),
);

if (! empty($model) && ! is_null($model->getPrimaryKey())){
	$this->menu['update'] = array(
		'label'		=>	Yii::t('app', 'Update'). ' ' . Yii::t('isms', 'Emailsetting'),
		'url'		=>	array('update', 'id' => $model->getPrimaryKey()),
		'active'	=>	($current == 'update'),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Emailsetting.Update'),
	);
	$this->menu['view'] = array(
		'label'		=>	Yii::t('app', 'View'). ' ' . Yii::t('isms', 'Emailsetting'),
		'url'		=>	array('view', 'id' => $model->getPrimaryKey()),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Emailsetting.View'),
		'active'	=>	($current == 'view'),
	);
	$this->menu['delete'] = array(
		'label'		=>	Yii::t('app', 'Delete'). ' ' . Yii::t('isms', 'Emailsetting'),
		'url'		=>	'#',
		'linkOptions'=>array(

			'submit'	=>	array('delete', 'id' => $model->getPrimaryKey()),
			'confirm'	=>	Yii::t('isms', 'Are you sure you want to delete this Emailsetting?'),
		),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Emailsetting.Delete'),
		'active'	=>	($current == 'delete'),
	);
}
