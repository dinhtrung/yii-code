<div class="form">
<p class="note"><?php echo Yii::t('isms', 'Fields with <span class="required">*</span> are required.');?></p>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'cpworktime-form',
		'enableAjaxValidation'=>true,
		'htmlOptions' => array(
				'enctype' => 'multipart/form-data'
		) ,
	));
	echo $form->errorSummary($model);
?>


<div class="row">
	<?php echo $form->labelEx($model,'cid'); ?>
	<?php echo $form->dropDownList($model, 'cid',
					CHtml::listData(Campaign::model()->findAll(), 'id', 'title')
				); ?>
	<?php echo $form->error($model,'cid'); ?>
	<p class="hint"><?php echo Yii::t('app', 'Select a campaign for this association.'); ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'tid'); ?>
	<?php echo $form->dropDownList($model, 'tid',
					CHtml::listData(Worktime::model()->findAll(), 'id', 'time')
				); ?>
	<?php echo $form->error($model,'tid'); ?>
	<p class="hint"><?php echo Yii::t('app', 'Select a working time for this association.'); ?></p>
</div>


<?php echo CHtml::Button(Yii::t('isms', 'Cancel'), array(
			'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
