<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php echo $form->textField($model,'id'); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'entity'); ?>
                <?php echo $form->textField($model,'entity',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'pkey'); ?>
                <?php echo $form->textField($model,'pkey'); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'uid'); ?>
                <?php echo $form->textField($model,'uid'); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'createtime'); ?>
                <?php echo $form->textField($model,'createtime'); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'visible'); ?>
                <?php echo $form->checkBox($model,'visible'); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'comment'); ?>
                <?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
        </div>
    
        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('cms', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
