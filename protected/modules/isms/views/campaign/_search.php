<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'title'); ?>
                <?php echo $form->textField($model,'title',array('size'=>40,'maxlength'=>40)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'description'); ?>
                <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'codename'); ?>
                <?php echo $form->textField($model,'codename',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'request_owner'); ?>
                <?php echo $form->textField($model,'request_owner',array('size'=>40,'maxlength'=>40)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'datasender'); ?>
                <?php echo $form->textField($model,'datasender',array('size'=>60,'maxlength'=>80)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'tosubscriber'); ?>
                <?php echo $form->textArea($model,'tosubscriber',array('rows'=>6, 'cols'=>50)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'start'); ?>
                <?php echo $form->textField($model,'start'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'end'); ?>
                <?php echo $form->textField($model,'end'); ?>
        </div>


        <div class="row">
                <?php echo $form->label($model,'template'); ?>
                <?php echo $form->textArea($model,'template',array('rows'=>6, 'cols'=>50)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
