<?php

$this->breadcrumbs=array(
	Yii::t('app', 'Nodes')	=>	array(Yii::t('app', 'index')),
	Yii::t('app', 'Settings'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Node'));
?>

<h1><?php echo $this->pageTitle = Yii::t('node', "Node Settings"); ?></h1>


<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'node-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	));
	echo $form->errorSummary($model);
?>

<div class="row">
<?php echo $form->labelEx($model,'cid'); ?>
<?php echo $form->dropDownList($model,'cid',
	array('' => Yii::t('node', '-- Select Category for Node --')) + Category::getOption()); ?>
<?php echo $form->error($model,'cid'); ?>
<?php echo Yii::t('node', "Select the parent Category for type Node"); ?>
</div>

<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array( 'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('app', 'Save Settings'));
$this->endWidget(); ?>
</div> <!-- form -->
