<?php
$current = Yii::app()->getController()->getAction()->getId();
$this->menu['admin'] = array(
	'label'		=>	Yii::t('app', 'Index'). ' ' . Yii::t('isms', 'Datafile'),
	'url'		=>	array('index'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Datafile.Index'),
	'active'	=>	($current == 'index'),
);
$this->menu['create'] = array(
	'label'		=>	Yii::t('app', 'Create'). ' ' . Yii::t('isms', 'Datafile'),
	'url'		=>	array('create'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Datafile.Create'),
	'active'	=>	($current == 'create'),
);

if (! empty($model) && ! is_null($model->getPrimaryKey())){
	$this->menu['view'] = array(
		'label'		=>	Yii::t('app', 'View'). ' ' . Yii::t('isms', 'Datafile'),
		'url'		=>	array('view', 'id' => $model->getPrimaryKey()),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Datafile.View'),
		'active'	=>	($current == 'view'),
	);
	$this->menu['update'] = array(
		'label'		=>	Yii::t('app', 'Update'). ' ' . Yii::t('isms', 'Datafile'),
		'url'		=>	array('update', 'id' => $model->getPrimaryKey()),		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Datafile.Update'),
		'active'	=>	($current == 'update'),
	);
	$this->menu['delete'] = array(
		'label'		=>	Yii::t('app', 'Delete'). ' ' . Yii::t('isms', 'Datafile'),
		'url'		=>	'#',
		'linkOptions'=>array(

			'submit'	=>	array('delete','id'	=>	$model->getPrimaryKey()),
			'confirm'	=>	Yii::t('app', 'Are you sure you want to delete this Datafile?'),
		),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Datafile.Delete'),
		'active'	=>	($current == 'delete'),
	);
}
