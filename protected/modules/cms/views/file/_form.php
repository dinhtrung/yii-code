<div class="form">
<p class="note">
<?php echo Yii::t('cms','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'file-form',
    'enableAjaxValidation'	=>	FALSE,
    'enableClientValidation'	=>	TRUE,
	'htmlOptions'	=>	array('enctype' => 'multipart/form-data')
));
echo $form->errorSummary($model);
?>

<div class="row">
	<?php echo $form->labelEx($model,'title'); ?>
	<?php echo $form->textField($model,'title',array('size'=>40,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'title'); ?>
	<p class="hint"><?php if('_HINT_File.title' != $hint = Yii::t('cms', '_HINT_File.title')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'description'); ?>
	<?php echo $form->textArea($model,'description', array('cols' => 40, 'rows' => 5)); ?>
	<?php echo $form->error($model,'description'); ?>
	<p class="hint"><?php if('_HINT_File.description' != $hint = Yii::t('cms', '_HINT_File.description')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'name'); ?>
	<?php echo $form->fileField($model,'name'); ?>
	<?php echo $form->error($model,'name'); ?>
	<p class="hint"><?php if('_HINT_File.name' != $hint = Yii::t('cms', '_HINT_File.name')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'path'); ?>
	<?php echo $form->textField($model,'path',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'path'); ?>
	<p class="hint"><?php if('_HINT_File.path' != $hint = Yii::t('cms', '_HINT_File.path')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'entity'); ?>
	<?php echo $form->textField($model,'entity',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'entity'); ?>
	<p class="hint"><?php if('_HINT_File.entity' != $hint = Yii::t('cms', '_HINT_File.entity')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'pkey'); ?>
	<?php echo $form->textField($model,'pkey',array('size'=>10,'maxlength'=>10)); ?>
	<?php echo $form->error($model,'pkey'); ?>
	<p class="hint"><?php if('_HINT_File.pkey' != $hint = Yii::t('cms', '_HINT_File.pkey')) echo $hint; ?></p>
</div>


<?php
echo CHtml::Button(Yii::t('cms', 'Cancel'), array(
            'submit' => array('file/admin')));
echo CHtml::submitButton(Yii::t('cms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->