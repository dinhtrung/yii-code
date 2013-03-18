<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nodefile-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'	=>	array('enctype' => 'multipart/form-data'),
	));
	echo $form->errorSummary($model);
?>


<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'title'); ?>
<?php if('_HINT_Nodefile.title' != $hint = Yii::t('core', '_HINT_Nodefile.title')) echo $hint; ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$model->getDataProvider('files'),
));
?>

<?php
$config = require(Yii::getPathOfAlias("core.views.file._cform").'.php');
$this->widget('ext.multimodelform.MultiModelForm',array(
        'id' => 'item_form',
        'formConfig' => $config,
        'model' => $item,
        'validatedItems' => $valid,
        'data' => $model->files,
    ));
?>


<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array(
			'submit' => array('nodefile/admin')));
echo CHtml::submitButton(Yii::t('core', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
