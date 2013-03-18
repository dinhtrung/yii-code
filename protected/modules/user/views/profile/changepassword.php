<?php $this->pageTitle=Yii::app()->name . ' - '.Yii::t('user', "Change Password");
$this->breadcrumbs=array(
	Yii::t('user', "Profile") => array('/user/profile'),
	Yii::t('user', "Change Password"),
);
?>

<h2><?php echo Yii::t('user', "Change password"); ?></h2>
<?php echo $this->renderPartial('menu'); ?>

<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><?php echo Yii::t('user', 'Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	<p class="hint">
	<?php echo Yii::t('user', "Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton(Yii::t('user', "Save")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->