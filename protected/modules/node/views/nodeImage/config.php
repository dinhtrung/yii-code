<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nodeImage-form',
	'enableAjaxValidation'=>FALSE,
	'htmlOptions' => array('enctype'=>'multipart/form-data')
)); 
	echo $form->errorSummary($model);
?>
<div class="row">
<?php echo CHtml::label("alias", Yii::t("app", "Default Image")); ?>
<?php echo $form->textField($model, 'alias'); ?>
<?php echo $form->error($model,'alias'); ?>
<?php if('_HINT_NodeImage.alias' != $hint = Yii::t('core', '_HINT_NodeImage.alias')) echo $hint; ?>
</div>

<div class="row">
<?php echo CHtml::label("image", Yii::t("app", "Default Image")); ?>
<?php echo $form->fileField($model, 'image'); ?>
<?php echo $form->error($model,'image'); ?>
<?php if('_HINT_NodeImage.image' != $hint = Yii::t('core', '_HINT_NodeImage.image')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'cid'); ?>
<?php echo $form->dropDownList($model,'cid',
	array('' => Yii::t('core', '--- Select Parent Category ---')) + CHtml::listData( Category::model()->roots()->findAll(), "id", "title")); ?>
<?php echo $form->error($model,'category'); ?>
<?php if('_HINT_NodeImage.category' != $hint = Yii::t('core', '_HINT_NodeImage.category')) echo $hint; ?>
</div>



<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array(
			'submit' => array('nodeImage/admin'))); 
echo CHtml::submitButton(Yii::t('core', 'Save')); 
$this->endWidget(); ?>
</div> <!-- form -->
