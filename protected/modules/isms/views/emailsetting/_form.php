<div class="form">
<p class="note">
<?php echo Yii::t('isms','Fields with');?> <span class="required">*</span> <?php echo Yii::t('isms','are required');?>.
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'emailsetting-form',
	'enableAjaxValidation'=>true,
	));
	echo $form->errorSummary($model);
?>

<div class="row">
	<?php echo $form->labelEx($model,'hostname'); ?>
	<?php echo $form->textField($model,'hostname',array('size'=>40,'maxlength'=>40)); ?>
	<?php echo $form->error($model,'hostname'); ?>
	<?php if('_HINT_Emailsetting.hostname' != $hint = Yii::t('isms', '_HINT_Emailsetting.hostname')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'email'); ?>
<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'email'); ?>
<?php if('_HINT_Emailsetting.email' != $hint = Yii::t('isms', '_HINT_Emailsetting.email')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'password'); ?>
<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'password'); ?>
<?php if('_HINT_Emailsetting.password' != $hint = Yii::t('isms', '_HINT_Emailsetting.password')) echo $hint; ?>
</div>

<?php if (Yii::app()->getUser()->checkAccess('Isms.Emailsetting.Config'))
	$this->renderPartial('_config', array('form' => $form, 'model' => $model)); ?>


<?php
echo CHtml::Button(Yii::t('isms', 'Cancel'), array(
			'submit' => array('emailsetting/admin')));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
