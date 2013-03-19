<?php $this->breadcrumbs=array(
	Yii::t('user', "Profile")=>array('profile'),
	Yii::t('user', "Edit"),
);
?>
<h1><?php echo $this->pageTitle = Yii::t('user', 'Edit profile'); ?></h1>
<?php echo $this->renderPartial('menu'); ?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo Yii::t('user', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('user', 'Create') : Yii::t('user', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
