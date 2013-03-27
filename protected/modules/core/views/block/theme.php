<?php
$this->breadcrumbs=array(
	Yii::t('core', 'Blocks')	=>	'index',
	$model->title=>array('view','id'=>$model->bid),
	Yii::t('core', 'Update'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocks'));
?>

<h1><?php echo $this->pageTitle = Yii::t('core', 'Theme Configure for Block :block', array(':block' => $model));?></h1>

<div class="form">
	<p class="note">
		<?php echo Yii::t('core','Fields with');?> <span class="required">*</span> <?php echo Yii::t('core','are required');?>.
	</p>

<?php
$data = array();
foreach ($model->themes as $blockTheme){
	$data[$blockTheme->theme][] = $blockTheme;
}

echo CHtml::beginForm();
echo CHtml::errorSummary($item);
?>

<?php foreach (Website::themeOptions() as $theme => $name):?>

	<?php $this->beginWidget('CClipWidget', array('id'=>	$theme)); ?>
		<div class="row">
		<?php echo CHtml::label(Yii::t('core', "Region in :theme", array(":theme" => $name)), "region[$theme]"); ?>
		<?php echo CHtml::dropDownList("Blocktheme[$theme][region]", $item[$theme]->region,
		array("" => Yii::t('core', "-- Select region --")) + Website::regionOption($theme)); ?><br>
		<?php echo Yii::t('core', "The region in theme :theme", array(":theme" => $name)); ?>
		</div>

		<div class="row">
		<?php echo CHtml::label(Yii::t('core', "Weight in :theme", array(":theme" => $name)), "weight"); ?>
		<?php $this->widget('CStarRating',array(
			'id'	=>	"weight-$theme",
			'name'		=>	"Blocktheme[$theme][weight]",
			'value'		=>	$item[$theme]->weight,
			'titles' 	=> 	array(),
			'allowEmpty'=>	FALSE,
			'starCount'	=> 5
		)); ?><br>
		<?php echo Yii::t('core', "Position of the Portlet displayed in theme :theme", array(":theme" => $name)); ?>
		</div>
	<?php $this->endWidget(); ?>
<?php endforeach; ?>

<?php
$tabParameters = array();
foreach($this->clips as $key=>$clip){
    $tabParameters[$key] = array('title'	=>	$key, 'content'=>$clip);
	unset($this->clips[$key]);
}
?>

<?php
$this->widget('system.web.widgets.CTabView', array(
	'tabs'	=>	$tabParameters,
	'activeTab'	=>	Yii::app()->setting->get("Website", "theme", "classic"),
)); ?>

<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array(
			'submit' => array('block/admin')));
echo CHtml::submitButton(Yii::t('core', 'Save'));
echo CHtml::endForm(); ?>
</div> <!-- form -->
