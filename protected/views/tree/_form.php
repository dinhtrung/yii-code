<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'tree-form',
	'enableAjaxValidation'=>true,
	));
	echo $form->errorSummary($model);
?>


<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'title'); ?>
<?php if('_HINT_Tree.title' != $hint = Yii::t('app', '_HINT_Tree.title')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'description'); ?>
<?php if('_HINT_Tree.description' != $hint = Yii::t('app', '_HINT_Tree.description')) echo $hint; ?>
</div>



<div class="row">
<?php echo $form->labelEx($model,'root'); ?>
<?php echo $form->dropDownList($model,'root',
//	array('' => Yii::t('app', '--- Select Root ---')) + CHtml::listData($model->findAll(array('order'=>'lft')), 'id', 'title'));
	array('' => Yii::t('app', '--- Select Root ---')) + Tree::getOption());
?>
<?php echo $form->error($model,'root'); ?>
<?php if('_HINT_Tree.root' != $hint = Yii::t('app', '_HINT_Tree.root')) echo $hint; ?>
</div>


<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => array('tree/admin')));
echo CHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
