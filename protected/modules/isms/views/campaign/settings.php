<?php
if(!isset($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('campaign', 'Campaigns')	=>	array(Yii::t('app', 'index')),
	Yii::t('app', 'Settings'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Campaign'));
?>

<h1>
<?php echo $this->pageTitle = Yii::t('app', 'Settings') . ' ' . Yii::t('campaign', 'Campaigns  :name', array(':name' => CHtml::encode($model))); ?> </h1>


<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'campaign-form',
	'enableAjaxValidation'=>true,
	)); 
	echo $form->errorSummary($model);
?>
	<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>40,'maxlength'=>40)); ?>
<?php echo $form->error($model,'title'); ?>
<?php if('_HINT_Campaign.title' != $hint = Yii::t('campaign', '_HINT_Campaign.title')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'description'); ?>
<?php if('_HINT_Campaign.description' != $hint = Yii::t('campaign', '_HINT_Campaign.description')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'codename'); ?>
<?php echo $form->textField($model,'codename',array('size'=>20,'maxlength'=>20)); ?>
<?php echo $form->error($model,'codename'); ?>
<?php if('_HINT_Campaign.codename' != $hint = Yii::t('campaign', '_HINT_Campaign.codename')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'request_date'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
						 array(
								 'model'=>'$model',
								 'name'=>'Campaign[request_date]',
								 'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
								 'value'=>$model->request_date,
								 'htmlOptions'=>array('size'=>10, 'style'=>'width:80px !important'),
								 'options'=>array(
									 'showButtonPanel'=>true,
									 'changeYear'=>true,
									 'changeYear'=>true,
									 'dateFormat'=>'yy-mm-dd',
									 ),
								 )
							 );
					; ?>
<?php echo $form->error($model,'request_date'); ?>
<?php if('_HINT_Campaign.request_date' != $hint = Yii::t('campaign', '_HINT_Campaign.request_date')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'request_owner'); ?>
<?php echo $form->textField($model,'request_owner',array('size'=>40,'maxlength'=>40)); ?>
<?php echo $form->error($model,'request_owner'); ?>
<?php if('_HINT_Campaign.request_owner' != $hint = Yii::t('campaign', '_HINT_Campaign.request_owner')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'datasender'); ?>
<?php echo $form->textField($model,'datasender',array('size'=>60,'maxlength'=>80)); ?>
<?php echo $form->error($model,'datasender'); ?>
<?php if('_HINT_Campaign.datasender' != $hint = Yii::t('campaign', '_HINT_Campaign.datasender')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'tosubscriber'); ?>
<?php echo $form->textArea($model,'tosubscriber',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'tosubscriber'); ?>
<?php if('_HINT_Campaign.tosubscriber' != $hint = Yii::t('campaign', '_HINT_Campaign.tosubscriber')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'start'); ?>
<?php echo $form->textField($model,'start'); ?>
<?php echo $form->error($model,'start'); ?>
<?php if('_HINT_Campaign.start' != $hint = Yii::t('campaign', '_HINT_Campaign.start')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'end'); ?>
<?php echo $form->textField($model,'end'); ?>
<?php echo $form->error($model,'end'); ?>
<?php if('_HINT_Campaign.end' != $hint = Yii::t('campaign', '_HINT_Campaign.end')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'status'); ?>
<?php echo $form->textField($model,'status'); ?>
<?php echo $form->error($model,'status'); ?>
<?php if('_HINT_Campaign.status' != $hint = Yii::t('campaign', '_HINT_Campaign.status')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'active'); ?>
<?php echo $form->checkBox($model,'active'); ?>
<?php echo $form->error($model,'active'); ?>
<?php if('_HINT_Campaign.active' != $hint = Yii::t('campaign', '_HINT_Campaign.active')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'sender'); ?>
<?php echo $form->textField($model,'sender',array('size'=>20,'maxlength'=>20)); ?>
<?php echo $form->error($model,'sender'); ?>
<?php if('_HINT_Campaign.sender' != $hint = Yii::t('campaign', '_HINT_Campaign.sender')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'ready'); ?>
<?php echo $form->textField($model,'ready'); ?>
<?php echo $form->error($model,'ready'); ?>
<?php if('_HINT_Campaign.ready' != $hint = Yii::t('campaign', '_HINT_Campaign.ready')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'type'); ?>
<?php echo $form->checkBox($model,'type'); ?>
<?php echo $form->error($model,'type'); ?>
<?php if('_HINT_Campaign.type' != $hint = Yii::t('campaign', '_HINT_Campaign.type')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'throughput'); ?>
<?php echo $form->textField($model,'throughput'); ?>
<?php echo $form->error($model,'throughput'); ?>
<?php if('_HINT_Campaign.throughput' != $hint = Yii::t('campaign', '_HINT_Campaign.throughput')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'col'); ?>
<?php echo $form->textField($model,'col'); ?>
<?php echo $form->error($model,'col'); ?>
<?php if('_HINT_Campaign.col' != $hint = Yii::t('campaign', '_HINT_Campaign.col')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'isdncol'); ?>
<?php echo $form->textField($model,'isdncol'); ?>
<?php echo $form->error($model,'isdncol'); ?>
<?php if('_HINT_Campaign.isdncol' != $hint = Yii::t('campaign', '_HINT_Campaign.isdncol')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'template'); ?>
<?php echo $form->textArea($model,'template',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'template'); ?>
<?php if('_HINT_Campaign.template' != $hint = Yii::t('campaign', '_HINT_Campaign.template')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'priority'); ?>
<?php echo $form->textField($model,'priority'); ?>
<?php echo $form->error($model,'priority'); ?>
<?php if('_HINT_Campaign.priority' != $hint = Yii::t('campaign', '_HINT_Campaign.priority')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'velocity'); ?>
<?php echo $form->textField($model,'velocity'); ?>
<?php echo $form->error($model,'velocity'); ?>
<?php if('_HINT_Campaign.velocity' != $hint = Yii::t('campaign', '_HINT_Campaign.velocity')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'cpworkday'); ?>
<?php echo $form->textField($model,'cpworkday',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'cpworkday'); ?>
<?php if('_HINT_Campaign.cpworkday' != $hint = Yii::t('campaign', '_HINT_Campaign.cpworkday')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'emailbox'); ?>
<?php echo $form->textField($model,'emailbox'); ?>
<?php echo $form->error($model,'emailbox'); ?>
<?php if('_HINT_Campaign.emailbox' != $hint = Yii::t('campaign', '_HINT_Campaign.emailbox')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'esubject'); ?>
<?php echo $form->textField($model,'esubject',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'esubject'); ?>
<?php if('_HINT_Campaign.esubject' != $hint = Yii::t('campaign', '_HINT_Campaign.esubject')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'eattachment'); ?>
<?php echo $form->textField($model,'eattachment',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'eattachment'); ?>
<?php if('_HINT_Campaign.eattachment' != $hint = Yii::t('campaign', '_HINT_Campaign.eattachment')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'ftpserver'); ?>
<?php echo $form->textField($model,'ftpserver'); ?>
<?php echo $form->error($model,'ftpserver'); ?>
<?php if('_HINT_Campaign.ftpserver' != $hint = Yii::t('campaign', '_HINT_Campaign.ftpserver')) echo $hint; ?>
</div>


<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
