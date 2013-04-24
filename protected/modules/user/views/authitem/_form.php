<div class="form span-12 first">

<?php if( $model->scenario==='update' ): ?>

	<h3><?php echo Rights::getAuthItemTypeName($model->type); ?></h3>

<?php endif; ?>

<?php $form=$this->beginWidget('CActiveForm'); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength'=>255, 'class'=>'text-field')); ?>
		<?php echo $form->error($model, 'name'); ?>
		<p class="hint"><?php echo Yii::t('user', 'Do not change the name unless you know what you are doing.'); ?></p>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model, 'bizRule'); ?>
		<?php echo $form->textField($model, 'bizRule', array('maxlength'=>255, 'class'=>'text-field')); ?>
		<?php echo $form->error($model, 'bizRule'); ?>
		<p class="hint"><?php echo Yii::t('user', 'Code that will be executed when performing access checking.'); ?></p>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model, 'data'); ?>
		<?php echo $form->textField($model, 'data', array('maxlength'=>255, 'class'=>'text-field')); ?>
		<?php echo $form->error($model, 'data'); ?>
		<p class="hint"><?php echo Yii::t('user', 'Additional data available when executing the business rule.'); ?></p>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('user', 'Save')); ?>
		<?php echo CHtml::resetButton(Yii::t('user', 'Cancel')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>