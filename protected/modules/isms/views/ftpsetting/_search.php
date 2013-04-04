<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>


        <div class="row">
                <?php echo $form->label($model,'title'); ?>
                <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'description'); ?>
                <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'hostname'); ?>
                <?php echo $form->textField($model,'hostname',array('size'=>40,'maxlength'=>40)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'username'); ?>
                <?php echo $form->textField($model,'username',array('size'=>40,'maxlength'=>40)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('isms', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
