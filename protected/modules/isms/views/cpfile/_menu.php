<?php
$current = Yii::app()->getController()->getAction()->getId();
$this->menu['admin'] = array(
	'label'		=>	Yii::t('app', 'Manage'). ' ' . Yii::t('isms', 'Cpfile'),
	'url'		=>	array('index'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Cpfile.Index'),
	'active'	=>	($current == 'index'),
);
$this->menu['create'] = array(
	'label'		=>	Yii::t('app', 'Create'). ' ' . Yii::t('isms', 'Cpfile'),
	'url'		=>	array('create'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Cpfile.Create'),
	'active'	=>	($current == 'create'),
);

if (! empty($model) && ! is_null($model->getPrimaryKey())){
	$this->menu['view'] = array(
		'label'		=>	Yii::t('app', 'View'). ' ' . Yii::t('isms', 'Cpfile'),
		'url'		=>	array_merge(array('view'), $model->getPrimaryKey()),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Cpfile.View'),
		'active'	=>	($current == 'view'),
	);
	$this->menu['update'] = array(
		'label'		=>	Yii::t('app', 'Update'). ' ' . Yii::t('isms', 'Cpfile'),
		'url'		=>	array_merge(array('update'), $model->getPrimaryKey()),
		'active'	=>	($current == 'update'),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Cpfile.Update'),
	);
	$this->menu['delete'] = array(
		'label'		=>	Yii::t('app', 'Delete'). ' ' . Yii::t('isms', 'Cpfile'),
		'url'		=>	'#',
		'linkOptions'=>array(
			'submit'	=>	array_merge(array('delete'), $model->getPrimaryKey()),
			'confirm'	=>	Yii::t('app', 'Are you sure you want to delete this Cpfile?'),
		),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Cpfile.Delete'),
		'active'	=>	($current == 'delete'),
	);
}
