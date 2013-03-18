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
                <?php echo $form->label($model,'title'); ?>
                <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'description'); ?>
                <?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'name'); ?>
                <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'path'); ?>
                <?php echo $form->textField($model,'path',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'parent_id'); ?>
                <?php echo $form->textField($model,'parent_id'); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'version'); ?>
                <?php echo $form->textField($model,'version'); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'ext'); ?>
                <?php echo $form->textField($model,'ext',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'size'); ?>
                <?php echo $form->textField($model,'size',array('size'=>10,'maxlength'=>10)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'type'); ?>
                <?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'entity'); ?>
                <?php echo $form->textField($model,'entity',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'pkey'); ?>
                <?php echo $form->textField($model,'pkey',array('size'=>10,'maxlength'=>10)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'createtime'); ?>
                <?php echo $form->textField($model,'createtime',array('size'=>10,'maxlength'=>10)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'updatetime'); ?>
                <?php echo $form->textField($model,'updatetime',array('size'=>10,'maxlength'=>10)); ?>
        </div>
    
        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
