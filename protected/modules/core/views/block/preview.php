<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs = array(
	'Blocks',
	Yii::t('app', 'Index'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocks'));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Preview') . ' ' . Yii::t('block', "Blocks"); ?></h1>

<?php foreach ($model as $block){
	if (array_key_exists($block->region, $this->page)) $this->page[$block->region] = "";
	$this->page[$block->region] = $block->owner->render();
}?>