<?php
$current = Yii::app()->getController()->getAction()->getId();
$this->menu['admin'] = array(
	'label'		=>	Yii::t('app', 'Manage'). ' ' . Yii::t('isms', 'Campaign'),
	'url'		=>	array('index'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Campaign.Index'),
	'active'	=>	($current == 'index'),
);

$this->menu['export'] = array(
	'label'		=>	'Xuất danh sách chương trình',
	'url'		=>	array('index', 'view' => 'export'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Campaign.Index'),
	'active'	=>	($current == 'export'),
);


$this->menu['create'] = array(
	'label'		=>	Yii::t('app', 'Create'). ' ' . Yii::t('isms', 'Campaign'),
	'url'		=>	array('create'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Campaign.Create'),
	'active'	=>	($current == 'create'),
);

if (! empty($model) && ! is_null($model->getPrimaryKey())){
	$this->menu['update'] = array(
		'label'		=>	Yii::t('app', 'Update'). ' ' . Yii::t('isms', 'Campaign'),
		'url'		=>	array('update', 'id' => $model->getPrimaryKey()),
		'active'	=>	($current == 'update'),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Campaign.Update'),
	);

	$this->menu['delete'] = array(
		'label'		=>	Yii::t('app', 'Delete'). ' ' . Yii::t('isms', 'Campaign'),
		'url'		=>	'#',
		'linkOptions'=>array(

			'submit'	=>	array('delete', 'id' => $model->getPrimaryKey()),
			'confirm'	=>	Yii::t('isms', 'Hãy khẳng định là bạn muốn xóa chương trình nhắn tin này?'),
		),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Campaign.Delete'),
		'active'	=>	($current == 'delete'),
	);

	$this->menu['excel'] = array(
		'label'		=>	Yii::t('app', 'Xuất danh sách tin đã gửi'),
		'url'		=>	'/isms/results/campaign_' . $model->getPrimaryKey() . ".tar.gz",
		'visible'	=>	file_exists('/var/www/isms/results/campaign_' . $model->getPrimaryKey() . ".tar.gz"),
	);

 $this->menu['dlr0'] = array(
                'label'         =>      Yii::t('app', 'Tin nhan chua gui duoc'),
                'url'           =>      '/isms/results/error_' . $model->getPrimaryKey() . ".tar.gz",
                'visible'       =>      file_exists('/var/www/isms/results/error_' . $model->getPrimaryKey() . ".tar.gz"),
        );

	$this->menu['filtered'] = array(
		'label'		=>	Yii::t('app', 'Xuất danh sách thuê bao đã bị lọc'),
		'url'		=>	'/isms/results/filtered_' . $model->getPrimaryKey() . ".tar.gz",
		'visible'	=>	file_exists('/var/www/isms/results/filtered_' . $model->getPrimaryKey() . ".tar.gz"),
	);
}
