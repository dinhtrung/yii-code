<?php
/* @var $this ContactsController */
/* @var $model Contacts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contacts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

<?php $this->beginClip("contacts"); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'owner'); ?>
		<?php echo $form->dropDownList($model, 'owner', array('' => Yii::t('user', '-- Select User --')) + CHtml::listData(User::model()->findAll(), 'id', 'username')); ?>
		<?php echo $form->error($model,'owner'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'first_name'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'last_name'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_by'); ?>
		<?php echo $form->textField($model,'order_by',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'order_by'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday'); ?>
		<?php echo $form->error($model,'birthday'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job'); ?>
		<?php echo $form->textField($model,'job',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'job'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'company'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'department'); ?>
		<?php echo $form->textArea($model,'department',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'department'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'type'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email2'); ?>
		<?php echo $form->textField($model,'email2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email2'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'phone'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone2'); ?>
		<?php echo $form->textField($model,'phone2',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'phone2'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'fax'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'mobile'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address1'); ?>
		<?php echo $form->textField($model,'address1',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'address1'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address2'); ?>
		<?php echo $form->textField($model,'address2',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'address2'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'city'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'state'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zip'); ?>
		<?php echo $form->textField($model,'zip',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'zip'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'country'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jabber'); ?>
		<?php echo $form->textField($model,'jabber',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'jabber'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'icq'); ?>
		<?php echo $form->textField($model,'icq',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'icq'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'msn'); ?>
		<?php echo $form->textField($model,'msn',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'msn'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yahoo'); ?>
		<?php echo $form->textField($model,'yahoo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'yahoo'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aol'); ?>
		<?php echo $form->textField($model,'aol',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'aol'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project'); ?>
		<?php echo $form->textField($model,'project'); ?>
		<?php echo $form->error($model,'project'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'icon'); ?>
		<?php echo $form->textField($model,'icon',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'icon'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'private'); ?>
		<?php echo $form->textField($model,'private'); ?>
		<?php echo $form->error($model,'private'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

<?php $this->endClip(); ?>

<?php
$this->widget("CTabView", array(
	"tabs"	=>	array(
	    "contacts"=>array(
	          "title"	=>	Yii::t("app", "contacts"),
	          "content"	=>	$this->clips["contacts"],
	    ),
	)
));
?>	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Save')); ?>
		<?php echo CHtml::resetButton(Yii::t('app', 'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->