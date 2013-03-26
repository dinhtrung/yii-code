<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'blacklist-form',
	'enableAjaxValidation' => true,
));
echo $form->errorSummary($model);
?>
	<div class="row">
<?php echo $form->labelEx($model, 'isdn'); ?>
<?php echo $form->textField($model, 'isdn', array(
	'size' => 20,
	'maxlength' => 20
)); ?>
<?php echo $form->error($model, 'isdn'); ?>
<p class="hint"><?php if ('_HINT_Blacklist.isdn' != $hint = Yii::t('isms', '_HINT_Blacklist.isdn')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model, 'fid'); ?>
	<?php echo $form->dropDownList($model, 'fid', CHtml::listData(Filter::model()->findAll() , 'id', 'title')); ?>
	<?php echo $form->error($model, 'fid'); ?>
	<p class="hint"><?php if ('_HINT_Campaign.fid' != $hint = Yii::t('isms', '_HINT_Campaign.fid')) echo $hint; ?></p>
</div>


<?php
echo CHtml::Button(Yii::t('isms', 'Cancel') , array(
	'submit' => array(
		'blacklist/admin'
	)
));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
