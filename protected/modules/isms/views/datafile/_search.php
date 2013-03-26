<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'fid'); ?>
                <?php echo $form->textField($model,'fid'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'title'); ?>
                <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'description'); ?>
                <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'createtime'); ?>
                <?php echo $form->textField($model,'createtime',array('size'=>10,'maxlength'=>10)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'filename'); ?>
                <?php echo $form->textField($model,'filename',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'uri'); ?>
                <?php echo $form->textField($model,'uri',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'filemime'); ?>
                <?php echo $form->textField($model,'filemime',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'filesize'); ?>
                <?php echo $form->textField($model,'filesize',array('size'=>10,'maxlength'=>10)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'status'); ?>
                <?php echo $form->textField($model,'status'); ?>
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
