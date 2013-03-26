<div class="form">
<p class="note">
<?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?>
</p>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'cpfile-form',
	'enableAjaxValidation' => true,
));
echo $form->errorSummary($model);
?>

<div class="row">
	<?php echo $form->labelEx($model, 'cid'); ?>
	<?php echo $form->dropDownList($model, 'cid', CHtml::listData(Campaign::model()->findAll(), 'id', 'title')); ?>
	<?php echo $form->error($model, 'cid'); ?>
	<p class="hint"><?php echo Yii::t('isms', 'Select a campaign for this association...'); ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model, 'fid'); ?>
	<?php echo $form->dropDownList($model, 'fid', CHtml::listData(Datafile::model()->findAll(), 'id', 'title')); ?>
	<?php echo $form->error($model, 'fid'); ?>
	<p class="hint"><?php echo Yii::t('isms', 'Select a file for this association...'); ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model, 'status'); ?>
	<?php echo $form->dropDownList($model, 'status', Cpfile::statusOption()); ?>
	<?php echo $form->error($model, 'status'); ?>
	<p class="hint"><?php echo Yii::t('isms', 'File handle status. 0: Not processed. 1: Processing. 2:Processed.'); ?></p>
</div>



<?php
echo CHtml::Button(Yii::t('isms', 'Cancel') , array( 'submit' => Yii::app()->getUser()->getReturnUrl() ));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
