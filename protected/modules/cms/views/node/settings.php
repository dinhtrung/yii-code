<?php

$this->breadcrumbs=array(
	Yii::t('core', 'Nodes')	=>	array(Yii::t('core', 'index')),
	Yii::t('core', 'Settings'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Node'));
?>

<h1><?php echo $this->pageTitle = Yii::t('core', "Node Settings"); ?></h1>


<div class="form">
<p class="note">
<?php echo Yii::t('core','Fields with <span class="required">*</span> are required.');?>
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
	array('' => Yii::t('core', '-- Select Category for Node --')) + Category::getOption()); ?>
<?php echo $form->error($model,'cid'); ?>
<?php echo Yii::t('core', "Select the parent Category for type Node"); ?>
</div>

<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array( 'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('core', 'Save Settings'));
$this->endWidget(); ?>
</div> <!-- form -->
