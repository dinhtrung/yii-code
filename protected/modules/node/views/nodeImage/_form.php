<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'nodeImage-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data')
	));
	echo $form->errorSummary($model);
?>
	<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'title'); ?>
<?php if('_HINT_NodeProducts.title' != $hint = Yii::t('core', '_HINT_NodeProducts.title')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'image'); ?>
<?php echo $form->fileField($model, 'image'); ?>
<?php echo $form->error($model,'image'); ?>
<?php if('_HINT_NodeProducts.image' != $hint = Yii::t('core', '_HINT_NodeProducts.image')) echo $hint; ?>
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
    ));
?>
<?php echo $form->error($model,'body'); ?>
<?php if('_HINT_NodeProducts.body' != $hint = Yii::t('core', '_HINT_NodeProducts.body')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'cid'); ?>
<?php echo $form->dropDownList($model,'cid',
	array('' => Yii::t('core', '--- Select Parent Category ---')) + Category::getOption(Yii::app()->setting->get("nodeImage", "cid", 1))); ?>
<?php echo $form->error($model,'cid'); ?>
<?php if('_HINT_NodeProducts.cid' != $hint = Yii::t('core', '_HINT_NodeProducts.cid')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'tags'); ?>
<?php $this->widget('CAutoComplete', array(
	'model' => $model,
	'attribute' => 'tags',
	'value' => $model->Taggable->toString(),
	'url'=>array('/core/tags/suggestTags'), //path to autocomplete URL
	'multiple'=>true,
	'mustMatch'=>false,
	'matchCase'=>false,
	'htmlOptions' => array('size'=>60,'maxlength'=>255),
)) ?>
<?php echo $form->error($model,'tags'); ?>
<?php if('_HINT_NodeProducts.tags' != $hint = Yii::t('core', '_HINT_NodeProducts.tags')) echo $hint; ?>
</div>


<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array(
			'submit' => array('nodeImage/admin')));
echo CHtml::submitButton(Yii::t('core', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
