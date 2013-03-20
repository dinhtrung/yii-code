<?php
$controller = Yii::app()->getController();
$resource = array();
if (! is_null($controller->getModule())) $resource[] = ucfirst($controller->getModule()->getId());
$resource[] = ucfirst($controller->getId());
$resource = implode('.', $resource) . '.';
$current = $controller->getAction()->getId();
$tmp = array('index', 'preview', 'sort', 'create');
foreach ($tmp as $actionId){
	$this->menu[$actionId] = array(
		'label'		=>	Yii::t('core', ucfirst($actionId)) . ' ' . Yii::t('core', ucfirst($modelClass)),
		'url'		=>	array($actionId),
		'visible'	=>	Yii::app()->getUser()->checkAccess($resource . ucfirst($actionId)),
		'active'	=>	($current == $actionId),
	);
}

if (! empty($model) && ! empty($primaryKey)){
	$tmp = array('view', 'configure', 'theme', 'duplicate', 'update', 'delete');
	foreach ($tmp as $actionId){
		$this->menu[$actionId] = array(
			'label'		=>	Yii::t('core', ucfirst($actionId)) . ' ' . Yii::t('core', ucfirst($modelClass)),
			'url'		=>	array($actionId, 'id' => $model->$primaryKey),
			'visible'	=>	Yii::app()->getUser()->checkAccess($resource . ucfirst($actionId)),
			'active'	=>	($current == $actionId),
		);
	}
	$this->menu['delete']['linkOptions']	=	array(
		'submit'	=>	array('delete','id'	=>	$model->$primaryKey),
		'confirm'	=>	Yii::t('core', 'Are you sure you want to delete this block?')
	);
}
