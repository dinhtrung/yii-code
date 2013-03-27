<?php

$this->breadcrumbs=array(
	Yii::t('core', 'Comments')	=>	array(Yii::t('core', 'index')),
	Yii::t('core', 'Settings'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Comments'));
?>

<h1><?php echo Yii::t('core', "Create Comments")</h1>


<div class="form">
<p class="note">
<?php echo Yii::t('core','Fields with');?> <span class="required">*</span> <?php echo Yii::t('core','are required');?>.
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'comments-form',
	'enableAjaxValidation'=>true,
	)); 
	echo $form->errorSummary($model);
?>
	<div class="row">
<?php echo $form->labelEx($model,'entity'); ?>
<?php echo $form->textField($model,'entity',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'entity'); ?>
<?php if('_HINT_Comments.entity' != $hint = Yii::t('core', '_HINT_Comments.entity')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'pkey'); ?>
<?php echo $form->textField($model,'pkey'); ?>
<?php echo $form->error($model,'pkey'); ?>
<?php if('_HINT_Comments.pkey' != $hint = Yii::t('core', '_HINT_Comments.pkey')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'uid'); ?>
<?php echo $form->textField($model,'uid'); ?>
<?php echo $form->error($model,'uid'); ?>
<?php if('_HINT_Comments.uid' != $hint = Yii::t('core', '_HINT_Comments.uid')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'visible'); ?>
<?php echo $form->checkBox($model,'visible'); ?>
<?php echo $form->error($model,'visible'); ?>
<?php if('_HINT_Comments.visible' != $hint = Yii::t('core', '_HINT_Comments.visible')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'comment'); ?>
<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'comment'); ?>
<?php if('_HINT_Comments.comment' != $hint = Yii::t('core', '_HINT_Comments.comment')) echo $hint; ?>
</div>


<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array(
			'submit' => array('comments/admin')));
echo CHtml::submitButton(Yii::t('core', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
