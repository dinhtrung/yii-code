<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nodeFile-form',
	'enableAjaxValidation'=>true,
	));
	echo $form->errorSummary($model);
?>
	<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'title'); ?>
<?php if('_HINT_Nodefile.title' != $hint = Yii::t('core', '_HINT_Nodefile.title')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'body'); ?>
<?php
DirectoryHelper::safe_directory(Yii::getPathOfAlias( "webroot") . DIRECTORY_SEPARATOR . Yii::app()->setting->get("File", "path", "files"));
$this->widget('ext.widgets.editor.CKkceditor',array(
        "model"=>$model,                # Data-Model
        "attribute"=>'body',         # Attribute in the Data-Model
        "height"=>'400px',
        "width"=>'100%',
        "filespath"	=>	Yii::getPathOfAlias( "webroot") . DIRECTORY_SEPARATOR . Yii::app()->setting->get("File", "path", "files"),
        "filesurl"	=>	Yii::app()->baseUrl . "/". Yii::app()->setting->get("File", "path", "files") . "/",
    ) );
?>
<?php echo $form->error($model,'body'); ?>
<?php if('_HINT_Nodefile.body' != $hint = Yii::t('core', '_HINT_Nodefile.body')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'cid'); ?>
<?php echo $form->dropDownList($model,'cid',
	array('' => Yii::t('core', '--- Select Parent Category ---')) + Category::getOption(1)); ?>
<?php echo $form->error($model,'category'); ?>
<?php if('_HINT_Nodefile.category' != $hint = Yii::t('core', '_HINT_Nodefile.category')) echo $hint; ?>
</div>
<br>
<div class="row">
<?php echo $form->labelEx($model,'tags'); ?>
<?php $this->widget('CAutoComplete', array(
	'model' => $model,
	'attribute' => 'tags',
	'value' => $model->Taggable->toString(),
	'url'	=>	array('/core/tags/suggestTags'),
	'multiple'=>true,
	'mustMatch'=>false,
	'matchCase'=>false,
	'htmlOptions' => array('size'=>60,'maxlength'=>255),
)) ?>
<?php echo $form->error($model,'tags'); ?>
<p class="hint"><?php echo Yii::t('core', "Please separate different tags with commas."); ?></p>
<?php if('_HINT_Nodefile.tags' != $hint = Yii::t('core', '_HINT_Nodefile.tags')) echo $hint; ?>
</div>


<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array(
			'submit' => array('nodefile/admin')));
echo CHtml::submitButton(Yii::t('core', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
