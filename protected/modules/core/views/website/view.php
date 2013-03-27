<?php
$this->breadcrumbs=array(
	Yii::t('core', 'Available Website') => array('index'),
	Yii::t('core', 'Configure Website'),
);?>
<?php if(empty($this->menu))
	$this->menu=array(
		array('label'=>Yii::t('core', 'Available Website'),
			'url'=>array('index')),
	);?>
<?php
$themeinfo = Website::getThemeInfo(Yii::app()->getTheme()->getName());

if (empty($themeinfo["region"])) $themeinfo["region"] = array();
foreach ($themeinfo["region"] as $id => $name){
	$this->page[$id] = $this->renderPartial("blocks/dummy", array("region" => $id, "name" => $name), TRUE);
}
$this->renderPartial('//site/index'); ?>
