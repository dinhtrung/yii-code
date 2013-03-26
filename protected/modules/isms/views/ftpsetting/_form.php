<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ftpsetting-form',
	'enableAjaxValidation'=>true,
));
echo $form->errorSummary($model);
?>
<div class="row">
	<?php echo $form->labelEx($model,'title'); ?>
	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'title'); ?>
	<?php if('_HINT_Ftpsetting.title' != $hint = Yii::t('isms', '_HINT_Ftpsetting.title')) echo $hint; ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'description'); ?>
	<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	<?php echo $form->error($model,'description'); ?>
	<?php if('_HINT_Ftpsetting.description' != $hint = Yii::t('isms', '_HINT_Ftpsetting.description')) echo $hint; ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'hostname'); ?>
	<?php echo $form->textField($model,'hostname',array('size'=>40,'maxlength'=>40)); ?>
	<?php echo $form->error($model,'hostname'); ?>
	<?php if('_HINT_Ftpsetting.hostname' != $hint = Yii::t('isms', '_HINT_Ftpsetting.hostname')) echo $hint; ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'path'); ?>
	<?php echo $form->textField($model,'path',array('size'=>40,'maxlength'=>40)); ?>
	<?php echo $form->error($model,'path'); ?>
	<?php if('_HINT_Ftpsetting.path' != $hint = Yii::t('isms', '_HINT_Ftpsetting.path')) echo $hint; ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'username'); ?>
	<?php echo $form->textField($model,'username',array('size'=>40,'maxlength'=>40)); ?>
	<?php echo $form->error($model,'username'); ?>
	<?php if('_HINT_Ftpsetting.username' != $hint = Yii::t('isms', '_HINT_Ftpsetting.username')) echo $hint; ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password',array('size'=>40,'maxlength'=>40)); ?>
	<?php echo $form->error($model,'password'); ?>
	<?php if('_HINT_Ftpsetting.password' != $hint = Yii::t('isms', '_HINT_Ftpsetting.password')) echo $hint; ?>
</div>


<?php
echo CHtml::Button(Yii::t('isms', 'Cancel'), array(
			'submit' => array('ftpsetting/admin')));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
