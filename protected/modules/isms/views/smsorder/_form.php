<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'smsorder-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<p class="note">
	<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
	</p>




	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Enter a title for this order.'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Enter a brief description for this order.'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', Smsorder::statusOption()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userid'); ?>
		<?php echo $form->dropDownList($model, 'userid',
				array('' => Yii::t('isms', '--- Select User ---')) + CHtml::listData(
						User::model()->findAll('org != 0'), 'id', 'username')); ?>
		<?php echo $form->error($model,'userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expired'); ?>
		<?php $this->widget('ext.widgets.datetimepicker.CJuiDateTimePicker', array(
			'model' => $model,
			'attribute' => 'expired',
			'htmlOptions' => array(
				'size' => 20,
			) ,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
			) ,
		));; ?>
		<?php echo $form->error($model,'expired'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'smscount'); ?>
		<?php echo $form->textField($model,'smscount'); ?>
		<?php echo $form->error($model,'smscount'); ?>
	</div>


<?php
echo CHtml::Button(Yii::t('app', 'Cancel') , array( 'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('app', 'Save'));

$this->endWidget(); ?>

</div><!-- form -->
