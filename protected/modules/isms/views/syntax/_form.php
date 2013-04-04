<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'syntax-form',
	'enableAjaxValidation' => true,
));
echo $form->errorSummary($model);
?>

<div class="row">
	<?php echo $form->labelEx($model, 'syntax'); ?>
	<?php echo $form->textField($model, 'syntax', array(
	'size' => 60,
	'maxlength' => 255
)); ?>
	<?php echo $form->error($model, 'syntax'); ?>
	<p class="hint"><?php if ('_HINT_Syntax.syntax' != $hint = Yii::t('isms', '_HINT_Syntax.syntax')) echo $hint; ?></p>
</div>
<div class="row">
	<?php echo $form->labelEx($model, 'fid'); ?>
	<?php echo $form->dropDownList($model, 'fid', CHtml::listData(Filter::model()->findAll() , 'id', 'title')); ?>
	<?php echo $form->error($model, 'fid'); ?>
	<p class="hint"><?php if ('_HINT_Syntax.fid' != $hint = Yii::t('isms', '_HINT_Syntax.fid')) echo $hint; ?></p>
</div>
<div class="row">
	<?php echo $form->labelEx($model, 'type'); ?>
	<?php echo $form->dropDownList($model, 'type', array(
	Yii::t('isms', 'No') ,
	Yii::t('isms', 'Yes')
)); ?>
	<?php echo $form->error($model, 'type'); ?>
	<p class="hint"><?php if ('_HINT_Syntax.type' != $hint = Yii::t('isms', '_HINT_Syntax.type')) echo $hint; ?></p>
</div>


<?php
echo CHtml::Button(Yii::t('app', 'Cancel') , array( 'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
