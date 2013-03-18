<div class="form">
<p class="note">
	<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'web-menu-form',
	'enableAjaxValidation'		=>	FALSE,
	'enableClientValidation'	=>	TRUE,
	'htmlOptions'	=>	array('enctype' => 'multipart/form-data')
));
	echo $form->errorSummary($model);
?>

<div class="row">
	<?php echo $form->labelEx($model,'label'); ?>
	<?php echo $form->textField($model,'label',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'label'); ?>
	<p class="hint"><?php if('_HINT_Webmenu.label' != $hint = Yii::t('webmenu', '_HINT_Webmenu.label')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'icon'); ?>
	<?php echo $form->fileField($model,'icon'); ?>
	<?php echo $form->error($model,'icon'); ?>
	<p class="hint"><?php if('_HINT_Webmenu.icon' != $hint = Yii::t('webmenu', '_HINT_Webmenu.icon')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'description'); ?>
	<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	<?php echo $form->error($model,'description'); ?>
	<p class="hint"><?php if('_HINT_Webmenu.description' != $hint = Yii::t('webmenu', '_HINT_Webmenu.description')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'url'); ?>
	<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'url'); ?>
	<p class="hint"><?php if('_HINT_Webmenu.url' != $hint = Yii::t('webmenu', '_HINT_Webmenu.url')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'root'); ?>
	<?php echo $form->dropDownList($model,'root',
		array('' => Yii::t('webmenu', '-- Select Parent Menu --')) + Webmenu::getMenuOption()); ?>
	<?php echo $form->error($model,'root'); ?>
	<p class="hint"><?php if('_HINT_Webmenu.root' != $hint = Yii::t('webmenu', '_HINT_Webmenu.root')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'template'); ?>
	<?php echo $form->textField($model,'template',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'template'); ?>
	<p class="hint"><?php if('_HINT_Webmenu.template' != $hint = Yii::t('webmenu', '_HINT_Webmenu.template')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'visible'); ?>
	<?php echo $form->checkBox($model,'visible'); ?>
	<?php echo $form->error($model,'visible'); ?>
	<p class="hint"><?php if('_HINT_Webmenu.visible' != $hint = Yii::t('webmenu', '_HINT_Webmenu.visible')) echo $hint; ?></p>
</div>


<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array( 'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
