<div class="form">
<p class="note">
<?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?>
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
<label for="f"><?php echo Yii::t('isms', 'Filter'); ?></label>
<?php $this->widget('Relation', array(
	'model' => $model,
	'relation' => 'f',
	'fields' => 'title',
	'allowEmpty' => false,
	'style' => 'dropdownlist',
	'htmlOptions' => array(
		'checkAll' => Yii::t('isms', 'Choose all') ,
	) ,
)); ?><br />
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
