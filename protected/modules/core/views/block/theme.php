<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	'Blocks'=>array('index'),
	$model->title=>array('view','id'=>$model->bid),
	Yii::t('app', 'Update'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blocks'));
?>

<h1><?php echo $this->pageTitle = Yii::t('block', 'Theme Configure for Block :block', array(':block' => $model));?></h1>

<div class="form">
	<p class="note">
		<?php echo Yii::t('block','Fields with');?> <span class="required">*</span> <?php echo Yii::t('block','are required');?>.
	</p>

<?php
$data = array();
foreach ($model->themes as $blockTheme){
	$data[$blockTheme->theme][] = $blockTheme;
}

echo CHtml::beginForm();
echo CHtml::errorSummary($item);
?>

<?php foreach (Webtheme::themeOptions() as $theme => $name):?>

	<?php $this->beginWidget('CClipWidget', array('id'=>	$theme)); ?>
		<div class="row">
		<?php echo CHtml::label(Yii::t("block", "Region in :theme", array(":theme" => $name)), "region[$theme]"); ?>
		<?php echo CHtml::dropDownList("Blocktheme[$theme][region]", $item[$theme]->region,
		array("" => Yii::t('block', "-- Select region --")) + Webtheme::regionOption($theme)); ?><br>
		<?php echo Yii::t("block", "The region in theme :theme", array(":theme" => $name)); ?>
		</div>

		<div class="row">
		<?php echo CHtml::label(Yii::t("block", "Weight in :theme", array(":theme" => $name)), "weight"); ?>
		<?php $this->widget('CStarRating',array(
			'id'	=>	"weight-$theme",
			'name'		=>	"Blocktheme[$theme][weight]",
			'value'		=>	$item[$theme]->weight,
			'titles' 	=> 	array(),
			'allowEmpty'=>	FALSE,
			'starCount'	=> 5
		)); ?><br>
		<?php echo Yii::t("block", "Position of the Portlet displayed in theme :theme", array(":theme" => $name)); ?>
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
	'activeTab'	=>	Yii::app()->setting->get("Webtheme", "theme", "classic"),
)); ?>

<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => array('block/admin')));
echo CHtml::submitButton(Yii::t('app', 'Save'));
echo CHtml::endForm(); ?>
</div> <!-- form -->
