<div class="form span-12 first">

<?php if( $model->scenario==='update' ): ?>

	<h3><?php echo Rights::getAuthItemTypeName($model->type); ?></h3>

<?php endif; ?>
	
<?php $form=$this->beginWidget('CActiveForm'); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength'=>255, 'class'=>'text-field')); ?>
		<?php echo $form->error($model, 'name'); ?>
		<p class="hint"><?php echo Yii::t('rights', 'Do not change the name unless you know what you are doing.'); ?></p>
	</div>

	<?php if( Rights::module()->enableBizRule===true ): ?>

		<div class="row">
			<?php echo $form->labelEx($model, 'bizRule'); ?>
			<?php echo $form->textField($model, 'bizRule', array('maxlength'=>255, 'class'=>'text-field')); ?>
			<?php echo $form->error($model, 'bizRule'); ?>
			<p class="hint"><?php echo Yii::t('rights', 'Code that will be executed when performing access checking.'); ?></p>
		</div>

	<?php endif; ?>

	<?php if( Rights::module()->enableBizRule===true && Rights::module()->enableBizRuleData ): ?>

		<div class="row">
			<?php echo $form->labelEx($model, 'data'); ?>
			<?php echo $form->textField($model, 'data', array('maxlength'=>255, 'class'=>'text-field')); ?>
			<?php echo $form->error($model, 'data'); ?>
			<p class="hint"><?php echo Yii::t('rights', 'Additional data available when executing the business rule.'); ?></p>
		</div>

	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('rights', 'Save')); ?> | <?php echo CHtml::link(Yii::t('rights', 'Cancel'), Yii::app()->user->rightsReturnUrl); ?>
	</div>

<?php $this->endWidget(); ?>

</div>