<?php
$controller = Yii::app()->getController();
$resource = array();
$resource[] = 'Isms';
$resource[] = 'Whitelist';
$resource = implode('.', $resource) . '.';
$current = $controller->getAction()->getId();
$tmp = array('index', 'create');
foreach ($tmp as $actionId){
	$this->menu[$actionId] = array(
		'label'		=>	Yii::t('app', ucfirst($actionId)) . ' ' . Yii::t($modelClass, ucfirst($modelClass)),
		'url'		=>	array($actionId),
		'visible'	=>	Yii::app()->getUser()->checkAccess($resource . ucfirst($actionId)),
		'active'	=>	($current == $actionId),
	);
}

if (! empty($model) && ! empty($primaryKey)){
	$tmp = array('update');
	foreach ($tmp as $actionId){
		$this->menu[$actionId] = array(
			'label'		=>	Yii::t('app', ucfirst($actionId)) . ' ' . Yii::t($modelClass, ucfirst($modelClass)),
			'url'		=>	array($actionId, 'id' => $model->$primaryKey),
			'visible'	=>	Yii::app()->getUser()->checkAccess($resource . ucfirst($actionId)),
			'active'	=>	($current == $actionId),
		);
	}
	$this->menu['delete']['linkOptions']	=	array(
		'submit'	=>	array('delete','id'	=>	$model->$primaryKey),
		'confirm'=>'Are you sure you want to delete this item?'
	);
}
