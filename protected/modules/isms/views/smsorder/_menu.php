<?php
$current = Yii::app()->getController()->getAction()->getId();
$this->menu['admin'] = array(
	'label'		=>	Yii::t('app', 'Manage'). ' ' . Yii::t('isms', 'Smsorder'),
	'url'		=>	array('index'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Smsorder.Index'),
	'active'	=>	($current == 'index'),
);
$this->menu['create'] = array(
	'label'		=>	Yii::t('app', 'Create'). ' ' . Yii::t('isms', 'Smsorder'),
	'url'		=>	array('create'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Smsorder.Create'),
	'active'	=>	($current == 'create'),
);

if (! empty($model) && ! is_null($model->getPrimaryKey())){
	$this->menu['view'] = array(
		'label'		=>	Yii::t('app', 'View'). ' ' . Yii::t('isms', 'Smsorder'),
		'url'		=>	array('view', 'id' => $model->getPrimaryKey()),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Smsorder.View'),
		'active'	=>	($current == 'view'),
	);
	$this->menu['export'] = array(
		'label'		=>	'Xuất danh sách chương trình',
		'url'		=>	array('view', 'id' => $model->getPrimaryKey(), 'view' => 'export'),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Smsorder.View'),
		'active'	=>	($current == 'export'),
	);
	$this->menu['update'] = array(
		'label'		=>	Yii::t('app', 'Update'). ' ' . Yii::t('isms', 'Smsorder'),
		'url'		=>	array('update', 'id' => $model->getPrimaryKey()),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Smsorder.Update'),
		'active'	=>	($current == 'update'),
	);
	$this->menu['delete'] = array(
		'label'		=>	Yii::t('app', 'Delete'). ' ' . Yii::t('isms', 'Smsorder'),
		'url'		=>	'#',
		'linkOptions'=>array(

			'submit'	=>	array('delete', 'id' => $model->getPrimaryKey()),
			'confirm'	=>	Yii::t('app', 'Are you sure you want to delete this Smsorder?'),
		),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Smsorder.Delete'),
		'active'	=>	($current == 'delete'),
	);
}
