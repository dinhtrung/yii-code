<?php
$current = Yii::app()->getController()->getAction()->getId();
$this->menu['admin'] = array(
	'label'		=>	Yii::t('app', 'Manage'). ' ' . Yii::t('isms', 'Ftpsetting'),
	'url'		=>	array('index'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Ftpsetting.Index'),
	'active'	=>	($current == 'index'),
);
$this->menu['create'] = array(
	'label'		=>	Yii::t('app', 'Create'). ' ' . Yii::t('isms', 'Ftpsetting'),
	'url'		=>	array('create'),
	'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Ftpsetting.Create'),
	'active'	=>	($current == 'create'),
);

if (! empty($model) && ! is_null($model->getPrimaryKey())){
	$this->menu['update'] = array(
		'label'		=>	Yii::t('app', 'Update'). ' ' . Yii::t('isms', 'Ftpsetting'),
		'url'		=>	array('update', 'id' => $model->getPrimaryKey()),
		'active'	=>	($current == 'update'),
	);
	$this->menu['delete'] = array(
		'label'		=>	Yii::t('app', 'Delete'). ' ' . Yii::t('isms', 'Ftpsetting'),
		'url'		=>	'#',
		'linkOptions'=>array(

			'submit'	=>	array('delete', 'id' => $model->getPrimaryKey()),
			'confirm'	=>	Yii::t('isms', 'Are you sure you want to delete this Ftpsetting?'),
		),
		'visible'	=>	Yii::app()->getUser()->checkAccess('Isms.Ftpsetting.Delete'),
		'active'	=>	($current == 'delete'),
	);
}
