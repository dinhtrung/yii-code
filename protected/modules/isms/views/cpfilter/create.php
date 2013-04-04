<?php
$this->breadcrumbs=array(
	Yii::t('app', 'CampaignFilter')		=>	array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->renderPartial('_menu');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create') ." ". Yii::t('app', 'CampaignFilter'); ?></h1>
<?php $this->renderPartial('_form', array('model' => $model)); ?>