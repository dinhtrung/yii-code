<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tickets-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="modal-body span-8">
		<p class="help-block">Fields with <span class="required">*</span> are required.</p>
	
		<?php echo $form->errorSummary($model); ?>
	
		<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>
	
		<?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>
		<?php echo $form->dropDownListRow($model,'root', array('' => Yii::t('projectbank', '-- Select Hierarchy --')) + Tickets::getOptions($model->root)); ?>
	</div>
	
	<div class="form-actions modal-footer span-5">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
        	'label'=>Yii::t('app', 'Cancel'),
			'buttonType' => 'reset',
			'type' => 'secondary',
        	'url'=>'#',
        	'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
	</div>

<?php $this->endWidget(); ?>
