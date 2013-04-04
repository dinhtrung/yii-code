<div class="form">
<p class="note">
<?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?>
</p>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'filter-form',
	'enableAjaxValidation' => true,
));
echo $form->errorSummary($model);
$syntax = Syntax::model()->findAllByAttributes(array('fid' => $model->getPrimaryKey()));
foreach ($syntax as $s){
	if ($s->type == Syntax::TYPE_BLACKLIST) $model->blackSyntax[] = $s->syntax;
	else $model->whiteSyntax[] = $s->syntax;
}
?>

<?php $this->beginClip('basic'); ?>
	<div class="row">
	<?php echo $form->labelEx($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array(
			'size' => 20,
			'maxlength' => 20
		)); ?>
		<?php echo $form->error($model, 'title'); ?>
		<p class="hint"><?php if ('_HINT_Filter.title' != $hint = Yii::t('isms', '_HINT_Filter.title')) echo $hint; ?></p>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model, 'description'); ?>
		<?php echo $form->textArea($model, 'description', array(
		'cols' => 60,
		'rows'	=>	5,
		'maxlength' => 256
	)); ?>
		<?php echo $form->error($model, 'description'); ?>
		<p class="hint"><?php if ('_HINT_Filter.description' != $hint = Yii::t('isms', '_HINT_Filter.description')) echo $hint; ?></p>
	</div>


<?php $this->endClip(); ?>

<?php $this->beginClip('accept'); ?>
	<div class="row">
		<?php if (is_array($model->whiteSyntax)) $model->whiteSyntax = implode("\n", $model->whiteSyntax); ?>
		<?php echo $form->labelEx($model, 'whiteSyntax'); ?>
		<?php echo $form->textArea($model, 'whiteSyntax'); ?>
		<?php echo $form->error($model, 'whiteSyntax'); ?>
		<p class="hint"><?php if ('_HINT_Filter.whiteSyntax' != $hint = Yii::t('isms', '_HINT_Filter.whiteSyntax')) echo $hint; ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'reply_accept'); ?>
		<?php echo $form->textArea($model, 'reply_accept', array( 'cols' => 60, 'maxlength' => 256 )); ?>
		<?php echo $form->error($model, 'reply_accept'); ?>
		<p class="hint"><?php if ('_HINT_Filter.reply_accept' != $hint = Yii::t('isms', '_HINT_Filter.reply_accept')) echo $hint; ?></p>
	</div>

	<?php if (Yii::app()->getUser()->checkAccess('Isms.Ftpsetting.View')): ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'ftpwhite'); ?>
		<?php echo $form->dropDownList($model, 'ftpwhite',
				array('' => Yii::t('isms', '-- No synchronize --')) + CHtml::listData(Ftpsetting::model()->findAll(), 'id', 'title')); ?>
		<?php echo $form->error($model, 'ftpwhite'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'Select a FTP Connection to synchronize white list...'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'ftpwhitefile'); ?>
		<?php echo $form->textField($model, 'ftpwhitefile', array( 'cols' => 60, 'maxlength' => 256 )); ?>
		<?php echo $form->error($model, 'ftpwhitefile'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'File name prefix to synchronize. For example, <code>9241_</code> will match files like <code>9241_2012-03-20.zip</code>'); ?></p>
	</div>
	<?php endif;?>
<?php $this->endClip(); ?>


<?php $this->beginClip('refuse'); ?>
	<div class="row">
	<?php if (is_array($model->blackSyntax)) $model->blackSyntax = implode("\n", $model->blackSyntax); ?>
		<?php echo $form->labelEx($model, 'blackSyntax'); ?>
		<?php echo $form->textArea($model, 'blackSyntax'); ?>
		<?php echo $form->error($model, 'blackSyntax'); ?>
		<p class="hint"><?php if ('_HINT_Filter.blackSyntax' != $hint = Yii::t('isms', '_HINT_Filter.blackSyntax')) echo $hint; ?></p>
	</div>
	<div class="row">
	<?php echo $form->labelEx($model, 'reply_refuse'); ?>
		<?php echo $form->textArea($model, 'reply_refuse', array(
			'cols' => 60,
			'maxlength' => 256
		)); ?>
		<?php echo $form->error($model, 'reply_refuse'); ?>
		<p class="hint"><?php if ('_HINT_Filter.reply_refuse' != $hint = Yii::t('isms', '_HINT_Filter.reply_refuse')) echo $hint; ?></p>
	</div>

	<?php if (Yii::app()->getUser()->checkAccess('Isms.Ftpsetting.View')): ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'ftpblack'); ?>
		<?php echo $form->dropDownList($model, 'ftpblack',
				array('' => Yii::t('isms', '-- No synchronize --')) + CHtml::listData(Ftpsetting::model()->findAll(), 'id', 'title')); ?>
		<?php echo $form->error($model, 'ftpblack'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'Select a FTP Connection to synchronize black list...'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'ftpblackfile'); ?>
		<?php echo $form->textField($model, 'ftpblackfile', array( 'cols' => 60, 'maxlength' => 256 )); ?>
		<?php echo $form->error($model, 'ftpblackfile'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'File name prefix to synchronize. For example, <code>9241_</code> will match files like <code>9241_2012-03-20.zip</code>'); ?></p>
	</div>
	<?php endif; ?>
<?php $this->endClip(); ?>


<?php
$this->widget('CTabView', array(
	'tabs'	=>	array(
	    'basic'=>array(
	          'title'	=>	Yii::t('isms', 'Basic Information') . '<span class="required">*</span>',
	          'content'	=>	$this->clips['basic'],
	    ),
	    'accept'=>array(
	          'title'	=>	Yii::t('isms', 'White list Configuration') . '<span class="required">*</span>',
	          'content'	=>	$this->clips['accept'],
	    ),
	    'refuse'=>array(
	          'title'	=>	Yii::t('isms', 'Black list Configuration') . '<span class="required">*</span>',
	          'content'	=>	$this->clips['refuse'],
	    ),
	)
));
?>

<?php
echo CHtml::Button(Yii::t('isms', 'Cancel') , array(
	'submit' => array(
		'filter/admin'
	)
));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
