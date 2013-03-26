<?php
$current = Yii::app()->getController()->getAction()->getId();
$this->menu['admin'] = array(
	'label'		=>	Yii::t('app', 'Manage'). ' ' . Yii::t('app', 'Sentsms'),
	'url'		=>	array('index'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Sentsms.Index'),
	'active'	=>	($current == 'index'),
);
$this->menu['overview'] = array(
	'label'		=>	'Bảng tổng soát chương trình',
	'url'		=>	array('overview'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Sentsms.Admin'),
	'active'	=>	($current == 'index'),
);
$this->menu['sendokxls'] = array(
	'label'		=>	'Xuất tin theo chương trình đã gửi thành công',
	'url'		=>	array('overview', 'viewfile' => 'sendokxls'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Sentsms.Admin'),
	'active'	=>	($current == 'index'),
);
$this->menu['sendokfailed'] = array(
	'label'		=>	'Xuất tin theo chương trình đã gửi thành công',
	'url'		=>	array('overview', 'viewfile' => 'sendfailedxls'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Sentsms.Admin'),
	'active'	=>	($current == 'index'),
);
$this->menu['create'] = array(
	'label'		=>	Yii::t('app', 'Create'). ' ' . Yii::t('app', 'Sentsms'),
	'url'		=>	array('create'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Sentsms.Create'),
	'active'	=>	($current == 'create'),
);

if (! empty($model) && ! is_null($model->getPrimaryKey())){
	$this->menu['view'] = array(
		'label'		=>	Yii::t('app', 'View'). ' ' . Yii::t('app', 'Sentsms'),
		'url'		=>	array('view', 'id' => $model->getPrimaryKey()),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Sentsms.View'),
		'active'	=>	($current == 'view'),
	);
	$this->menu['update'] = array(
		'label'		=>	Yii::t('app', 'Update'). ' ' . Yii::t('app', 'Sentsms'),
		'url'		=>	array('update', 'id' => $model->getPrimaryKey()),		'visible'	=>	Yii::app()->getUser()->checkAccess('Sentsms.Update'),
		'active'	=>	($current == 'update'),
	);
	$this->menu['delete'] = array(
		'label'		=>	Yii::t('app', 'Delete'). ' ' . Yii::t('app', 'Sentsms'),
		'url'		=>	'#',
		'linkOptions'=>array(

			'submit'	=>	array('delete','id'	=>	$model->getPrimaryKey()),
			'confirm'	=>	Yii::t('app', 'Are you sure you want to delete this Sentsms?'),
		),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Sentsms.Delete'),
		'active'	=>	($current == 'delete'),
	);
}
