<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'tags-form',
	'enableAjaxValidation'=>true,
	));
	echo $form->errorSummary($model);
?>
<div class="row">
<?php echo $form->labelEx($model,'name'); ?>
<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
<?php echo $form->error($model,'name'); ?>
<p class="hint"><?php if('_HINT_Tags.name' != $hint = Yii::t('tags', '_HINT_Tags.name')) echo $hint; ?></p>
</div>

<div class="row">
<?php echo $form->labelEx($model,'frequency'); ?>
<?php echo $form->textField($model,'frequency'); ?>
<?php echo $form->error($model,'frequency'); ?>
<p class="hint"><?php if('_HINT_Tags.frequency' != $hint = Yii::t('tags', '_HINT_Tags.frequency')) echo $hint; ?></p>
</div>


<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => array('tags/admin')));
echo CHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
