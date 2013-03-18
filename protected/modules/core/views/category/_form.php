<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'	=>	FALSE,
	'enableClientValidation' => TRUE,
));
	echo $form->errorSummary($model);
?>

<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'title'); ?>
<p class="hint"><?php if('_HINT_Category.title' != $hint = Yii::t('category', '_HINT_Category.title')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'description'); ?>
	<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	<?php echo $form->error($model,'description'); ?>
	<p class="hint"><?php echo Yii::t('app', 'You may use <a target="_blank" href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a>.')?></p>
</div>


<div class="row">
<?php echo $form->labelEx($model,'root'); ?>
<?php echo $form->dropDownList($model,'root',
	array('' => Yii::t('category', '--- Select Parent Category ---')) + Category::getOption()); ?>
<?php echo $form->error($model,'root'); ?>
<p class="hint"><?php if('_HINT_Category.root' != $hint = Yii::t('category', '_HINT_Category.root')) echo $hint; ?></p>
</div>



<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => array('category/admin')));
echo CHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
