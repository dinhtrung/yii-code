<?php
$rightGenerator = new RGenerator();
$modules = array_keys(Yii::app()->getModules());
sort($modules);
$panels = array();
foreach ($modules as $module) {
	$menu = array();
	$display = FALSE;
	$controllers = $rightGenerator->getControllersInPath(Yii::getPathOfAlias("application.modules.$module.controllers"));
	foreach ($controllers as $ctrl => $info) {
		$resource = ucfirst($module) . '.' . ucfirst($ctrl) . '.';
		$label = Yii::t(strtolower($module), $info['name']);
		if ($label == $info['name']) $label = Yii::t(strtolower($info['name']), $info['name']);
		$menu[] = array(
      								'label' 	=>  $label,
      								'url' 		=>  array("/$module/" . strtolower($info['name'])),
      								'visible'	=>	Yii::app()->getUser()->checkAccess($resource . 'Index'),
									'active'	=>	((Yii::app()->getController()->getId() == 'index') && is_object(Yii::app()->getController()->getModule()) && (Yii::app()->getController()->getModule()->getId() == $module)),
		);
		if (Yii::app()->getUser()->checkAccess($resource . 'Index')) $display = TRUE;
	}
	if ($display) {
		$panels[Yii::t(strtolower($module), ucfirst($module))] = $this->widget('zii.widgets.CMenu', array(
			'id'	=>	$module . '-menu',
		    'items'	=>	$menu,
		), TRUE);
	}
}
if ($panels){
	$this->widget('zii.widgets.jui.CJuiAccordion', array(
	    'panels'	=>	$panels,
	    'options'	=>	array(
	        'animated'=>'bounceslide',
		),
	));
}