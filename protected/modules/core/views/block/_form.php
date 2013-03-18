<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'block-form',
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
	));
	echo $form->errorSummary($model);
?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'Information')); ?>
<div class="row">
	<?php echo $form->labelEx($model,'title'); ?>
	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->error($model,'title'); ?>
	<p class="hint"><?php echo Yii::t('block', "Title of this block, to be displayed on Administration page."); ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'description'); ?>
	<?php echo $form->textArea($model,'description',array('rows'=>10, 'cols'=>70)); ?>
	<?php echo $form->error($model,'description'); ?>
	<p class="hint"><?php echo Yii::t('block', 'You may use <a target="_blank" href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a>.'); ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'type'); ?>
	<?php echo $form->dropDownList($model, 'type', Blocktype::listData()); ?>
	<?php echo $form->error($model,'type'); ?>
	<p class="hint"><?php echo Yii::t('block', "Block types provide various features to the CMS. Each block type will have its own behaviors."); ?></p>
</div>
<?php $this->endWidget(); ?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'Display Settings')); ?>
<div class="row">
	<?php echo $form->labelEx($model,'label'); ?>
	<?php echo $form->textField($model,'label',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'label'); ?>
	<p class="hint"><?php echo Yii::t('block', "If specified, the block will be render to the end users with this label."); ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'status'); ?>
	<?php echo $form->checkBox($model,'status'); ?>
	<?php echo $form->error($model,'status'); ?>
	<p class="hint"><?php echo Yii::t('block', "Temporary disable this block."); ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'display'); ?>
	<?php echo $form->radioButtonList($model,'display', Block::displayOption()); ?>
	<?php echo $form->error($model,'display'); ?>
	<p class="hint"><?php if('_HINT_Block.display' != $hint = Yii::t('block', '_HINT_Block.display')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'url'); ?>
	<?php echo $form->textArea($model,'url',array('rows'=>6, 'cols'=>50)); ?>
	<?php echo $form->error($model,'url'); ?>
	<p class="hint"><?php if('_HINT_Block.url' != $hint = Yii::t('block', '_HINT_Block.url')) echo $hint; ?></p>
</div>
<?php $this->endWidget(); ?>

<?php
$tabs = array();
foreach($this->clips as $key=>$clip){
    $tabs[TextHelper::utf2ascii($key, TRUE, '-')] = array(
        'title'		=>	Yii::t('block', $key),
        'content'	=>	$clip
    );
    unset($this->clips[$key]);
}
$this->widget('system.web.widgets.CTabView', array('tabs'=>$tabs));
?>


<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => array('block/admin')));
echo CHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
