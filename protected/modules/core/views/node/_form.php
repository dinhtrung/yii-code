<div class="form">
<p class="note">
<?php echo Yii::t('core','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'node-form',
		'enableAjaxValidation'=>true,
	));
	echo $form->errorSummary($model);
?>

<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'title'); ?>
<p class="hint"><?php if('_HINT_Node.title' != $hint = Yii::t('core', '_HINT_Node.title')) echo $hint; ?></p>
</div>

<div class="row">
<?php echo $form->labelEx($model,'body'); ?>
<?php DirectoryHelper::safe_directory(Yii::getPathOfAlias( "webroot") . DIRECTORY_SEPARATOR . Yii::app()->setting->get("File", "path", "files"));
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
<p class="hint"><?php if('_HINT_Node.body' != $hint = Yii::t('core', '_HINT_Node.body')) echo $hint; ?></p>
</div>

<div class="row">
<?php echo $form->labelEx($model,'status'); ?>
<?php echo $form->dropDownList($model,'status', Node::statusOption()); ?>
<?php echo $form->error($model,'category'); ?>
<p class="hint"><?php if('_HINT_Node.category' != $hint = Yii::t('core', '_HINT_Node.category')) echo $hint; ?></p>
</div>


<div class="row">
<?php echo $form->labelEx($model,'cid'); ?>
<?php echo $form->dropDownList($model,'cid',
	array('' => Yii::t('core', '--- Select Parent Category ---')) + Category::getOption(Yii::app()->setting->get("Node", "cid", 1))); ?>
<?php echo $form->error($model,'category'); ?>
<p class="hint"><?php if('_HINT_Node.category' != $hint = Yii::t('core', '_HINT_Node.category')) echo $hint; ?></p>
</div>

<div class="row">
<?php echo $form->labelEx($model,'tags'); ?>
<?php
$model->tags = implode(', ', $model->Taggable->getTags());
$this->widget('CAutoComplete', array(
	'model' => $model,
	'attribute' => 'tags',
	'url'=>array('/core/tags/suggestTags'), //path to autocomplete URL
	'multiple'=>true,
	'mustMatch'=>false,
	'matchCase'=>false,
	'htmlOptions' => array('size'=>60,'maxlength'=>255),
)) ?>
<?php echo $form->error($model,'tags'); ?>
<p class="hint"><?php if('_HINT_Node.tags' != $hint = Yii::t('core', '_HINT_Node.tags')) echo $hint; ?></p>
</div>


<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array( 'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('core', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
