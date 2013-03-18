<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'root'); ?>
                <?php echo $form->textField($model,'root',array('size'=>10,'maxlength'=>10)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'lft'); ?>
                <?php echo $form->textField($model,'lft',array('size'=>10,'maxlength'=>10)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'rgt'); ?>
                <?php echo $form->textField($model,'rgt',array('size'=>10,'maxlength'=>10)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'level'); ?>
                <?php echo $form->textField($model,'level'); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'title'); ?>
                <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'description'); ?>
                <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        </div>
    
        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
