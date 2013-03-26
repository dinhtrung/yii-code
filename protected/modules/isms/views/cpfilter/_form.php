<div class="form">
<p class="note"><?php echo Yii::t('isms', 'Fields with <span class="required">*</span> are required.');?></p>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'campaignfilter-form',
		'enableAjaxValidation'=>true,
		'htmlOptions' => array(
				'enctype' => 'multipart/form-data'
		) ,
	));
	echo $form->errorSummary($model);
?>

<?php $this->beginClip('basic'); ?>




<div class="row">
	<?php echo $form->labelEx($model,'cid'); ?>
	<?php echo $form->dropDownList($model, 'cid',
					CHtml::listData(Campaign::model()->findAll(), 'id', 'title')
				); ?>
	<?php echo $form->error($model,'cid'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'fid'); ?>
	<?php echo $form->dropDownList($model, 'fid',
					CHtml::listData(Filter::model()->findAll(), 'id', 'title')
				); ?>
	<?php echo $form->error($model,'fid'); ?>
</div>


<div class="row">
	<?php echo $form->labelEx($model,'type'); ?>
	<?php echo $form->dropDownList($model,'type', CampaignFilter::typeOption()); ?>
	<?php echo $form->error($model,'type'); ?>
	<p class="hint"><?php if ('_HINT_CampaignFilter.type' != $hint = Yii::t('isms', '_HINT_CampaignFilter.type')) echo $hint; ?></p>
</div>


<?php  $this->endClip(); ?>


<?php  $this->widget('CTabView', array(
			'tabs' => array(
			    'basic'=>array(
			          'title'	=>	Yii::t('isms', 'Basic') . '<span class="required">*</span>',
			          'content'	=> $this->clips['basic']
			    ),
			)
		)
	);
?>

<?php echo CHtml::Button(Yii::t('isms', 'Cancel'), array(
			'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
