<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nodeNodeGallery-form',
	'enableAjaxValidation'=>true,
));
	echo $form->errorSummary($model);
?>

<div class="row">
<?php echo $form->labelEx($model,'root'); ?>
<?php echo $form->dropDownList($model,'root',
	array('' => Yii::t('core', '--- Select Parent NodeGallery ---')) + Category::getOption()); ?>
<?php echo $form->error($model,'root'); ?>
<?php if('_HINT_NodeGallery.root' != $hint = Yii::t('core', '_HINT_NodeGallery.root')) echo $hint; ?>
</div>



<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array(
			'submit' => array('nodeNodeGallery/admin')));
echo CHtml::submitButton(Yii::t('core', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
