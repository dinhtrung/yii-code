<?php
if(empty($this->breadcrumbs))
$this->breadcrumbs=array(
	'Files'=>array(Yii::t('cms', 'index')),
	Yii::t('cms', 'Upload'),
);

if(empty($this->menu))
$this->menu=array(
	array('label'=>Yii::t('cms', 'List') . ' File', 'url'=>array('index')),
	array('label'=>Yii::t('cms', 'Manage') . ' File', 'url'=>array('admin')),
);
?>

<h1> Upload File </h1>

<div class="form">
<p class="note">
<?php echo Yii::t('cms','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'file-form',
    'enableAjaxValidation'=>false,
	'htmlOptions'	=>	array('enctype' => 'multipart/form-data')
    ));
    echo $form->errorSummary($model);
?>

<div class="row">
<?php echo $form->labelEx($model,'entity'); ?>
<?php echo $form->textField($model,'entity',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'entity'); ?>
<p class="hint"><?php if('_HINT_File.entity' != $hint = Yii::t('cms', '_HINT_File.entity')) echo $hint; ?></p>
</div>

<div class="row">
<?php echo $form->labelEx($model,'pkey'); ?>
<?php echo $form->textField($model,'pkey',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'pkey'); ?>
<p class="hint"><?php if('_HINT_File.pkey' != $hint = Yii::t('cms', '_HINT_File.pkey')) echo $hint; ?></p>
</div>

<?php
$this->widget('ext.multimodelform.MultiModelForm',array(
        'id' => 'item_form',
        'formConfig' => require(Yii::getPathOfAlias("realtimepbx.views.file._attach").'.php'),
        'model' => $item,
        'validatedItems' => $valid,
        'data' => array(),
    ));
?>

<?php
echo CHtml::Button(Yii::t('cms', 'Cancel'), array(
            'submit' => array('file/admin')));
echo CHtml::submitButton(Yii::t('cms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->