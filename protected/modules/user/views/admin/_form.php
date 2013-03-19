<div class="form">

<?php echo CHtml::beginForm('','post',array('enctype'=>'multipart/form-data')); ?>

	<p class="note"><?php echo Yii::t('user', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo CHtml::errorSummary(array($model)); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo CHtml::error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password',array('size'=>60,'maxlength'=>128, 'value' => '')); ?>
		<?php echo CHtml::error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'email'); ?>
		<?php echo CHtml::activeTextField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo CHtml::error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'role'); ?>
		<?php echo CHtml::activeDropDownList($model,'role',Rights::getAuthItemSelectOptions(CAuthItem::TYPE_ROLE)); ?>
		<?php echo CHtml::error($model,'role'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'status'); ?>
		<?php echo CHtml::activeDropDownList($model,'status',User::itemAlias('UserStatus')); ?>
		<?php echo CHtml::error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Save')); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->