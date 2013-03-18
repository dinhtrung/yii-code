<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nodeNodeDocument-form',
	'enableAjaxValidation'=>FALSE,
	'htmlOptions' => array('enctype'=>'multipart/form-data')
)); 
	echo $form->errorSummary($model);
?>
<div class="row">
<?php echo CHtml::label("alias", Yii::t("app", "Default Image")); ?>
<?php echo $form->textField($model, 'alias'); ?>
<?php echo $form->error($model,'alias'); ?>
<?php if('_HINT_NodeDocument.alias' != $hint = Yii::t('core', '_HINT_NodeDocument.alias')) echo $hint; ?>
</div>

<div class="row">
<?php echo CHtml::label("file", Yii::t("app", "Default Image")); ?>
<?php echo $form->fileField($model, 'file'); ?>
<?php echo $form->error($model,'file'); ?>
<?php if('_HINT_NodeDocument.file' != $hint = Yii::t('core', '_HINT_NodeDocument.file')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'cid'); ?>
<?php echo $form->dropDownList($model,'cid',
	array('' => Yii::t('core', '--- Select Parent Category ---')) + CHtml::listData( Category::model()->roots()->findAll(), "id", "title")); ?>
<?php echo $form->error($model,'category'); ?>
<?php if('_HINT_NodeDocument.category' != $hint = Yii::t('core', '_HINT_NodeDocument.category')) echo $hint; ?>
</div>



<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array(
			'submit' => array('nodeNodeDocument/admin'))); 
echo CHtml::submitButton(Yii::t('core', 'Save')); 
$this->endWidget(); ?>
</div> <!-- form -->
