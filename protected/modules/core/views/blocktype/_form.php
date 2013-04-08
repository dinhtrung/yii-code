<div class="form">
<p class="note">
<?php echo Yii::t('core','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'blocktype-form',
	'enableAjaxValidation'=>true,
	));
	echo $form->errorSummary($model);
?>

<div class="row">
	<?php echo $form->labelEx($model,'btid'); ?>
	<?php echo $form->textField($model,'btid',array('size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->error($model,'btid'); ?>
	<p class="hint"><?php echo Yii::t('core', "Machine name of this block type."); ?></p>
</div>


<div class="row">
	<?php echo $form->labelEx($model,'title'); ?>
	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->error($model,'title'); ?>
	<p class="hint"><?php echo Yii::t('core', "Name of this block type. Used in administration interfaces"); ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'description'); ?>
	<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>70)); ?>
	<?php echo $form->error($model,'description'); ?>
	<p class="hint"><?php echo Yii::t('core', 'You may use <a target="_blank" href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a>.')?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'component'); ?>
	<?php echo $form->textField($model,'component',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'component'); ?>
	<p class="hint"><?php echo Yii::t('core', "Yii Component that provide Callback Data and Config functions, written in Yii path alias."); ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'callback'); ?>
	<?php echo $form->textField($model,'callback',array('size'=>40,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'callback'); ?>
	<p class="hint"><?php echo Yii::t('core', "Prefix for the callback functions.<br> This block configuration will be provided by function <code><em>callback</em>Config</code> while data will be provided by <code><em>callback</em>Data</code> in the component above."); ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'viewfile'); ?>
	<?php echo $form->textField($model,'viewfile',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'viewfile'); ?>
	<p class="hint"><?php echo Yii::t('core', "The view file this block type will use. Provided as Yii path alias format."); ?></p>
	<div class="hint"><?php echo Yii::t('core', "Finds a view file based on its name. The view name can be in one of the following formats:<br>
	<ul>
		<li><strong>absolute view within a module:</strong> the view name starts with a single slash <kbd>'/'</kbd>. In this case, the view will be searched for under the currently active module's view path. If there is no active module, the view will be searched for under the application's view path.</li>
		<li><strong>absolute view within the application:</strong> the view name starts with double slashes <kbd>'//'</kbd>. In this case, the view will be searched for under the application's view path.</li>
		<li><strong>aliased view:</strong> the view name contains dots and refers to a path alias. The view file is determined by calling <code>YiiBase::getPathOfAlias()</code>. Note that aliased views cannot be themed because they can refer to a view file located at arbitrary places.</li>
		<li><strong>relative view:</strong> otherwise. Relative views will be searched for under the currently active controller's view path.</li>
	</ul>
	For absolute view and relative view, the corresponding view file is a PHP file whose name is the same as the view name. The file is located under a specified directory. This method will call CApplication::findLocalizedFile to search for a localized file, if any."); ?></div>
</div>

<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array(
			'submit' => array('blocktype/admin')));
echo CHtml::submitButton(Yii::t('core', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
