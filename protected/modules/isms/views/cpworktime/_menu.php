<?php
$current = Yii::app()->getController()->getAction()->getId();
$this->menu['admin'] = array(
	'label'		=>	Yii::t('app', 'Manage'). ' ' . Yii::t('app', 'Cpworktime'),
	'url'		=>	array('index'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Cpworktime.Index'),
	'active'	=>	($current == 'index'),
);
$this->menu['create'] = array(
	'label'		=>	Yii::t('app', 'Create'). ' ' . Yii::t('app', 'Cpworktime'),
	'url'		=>	array('create'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Cpworktime.Create'),
	'active'	=>	($current == 'create'),
);

if (! empty($model) && ! is_null($model->getPrimaryKey())){
	$this->menu['view'] = array(
		'label'		=>	Yii::t('app', 'View'). ' ' . Yii::t('app', 'Cpworktime'),
		'url'		=>	array_merge(array('view'), $model->getPrimaryKey()),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Cpworktime.View'),
		'active'	=>	($current == 'view'),
	);
	$this->menu['update'] = array(
		'label'		=>	Yii::t('app', 'Update'). ' ' . Yii::t('app', 'Cpworktime'),
		'url'		=>	array_merge(array('update'), $model->getPrimaryKey()),
		'active'	=>	($current == 'update'),
	);
	$this->menu['delete'] = array(
		'label'		=>	Yii::t('app', 'Delete'). ' ' . Yii::t('app', 'Cpworktime'),
		'url'		=>	'#',
		'linkOptions'=>array(

			'submit'	=>	array_merge(array('delete'), $model->getPrimaryKey()),
			'confirm'	=>	Yii::t('app', 'Are you sure you want to delete this Cpworktime?'),
		),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Cpworktime.Delete'),
		'active'	=>	($current == 'delete'),
	);
}
