<?php
$this->breadcrumbs=array(
	Yii::t('core', 'Blocks')	=>	'index',
	Yii::t('core', 'Preview'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocks'));
?>

<h1><?php echo $this->pageTitle = Yii::t('core', 'Preview') . ' ' . Yii::t('core', "Blocks"); ?></h1>

<?php foreach ($model as $block){
	if (array_key_exists($block->region, $this->page)) $this->page[$block->region] = "";
	$this->page[$block->region] = $block->owner->render();
}?>