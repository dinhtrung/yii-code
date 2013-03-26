<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'momt'); ?>
                <?php echo $form->textField($model,'momt',array('size'=>3,'maxlength'=>3)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'sender'); ?>
                <?php echo $form->textField($model,'sender',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'receiver'); ?>
                <?php echo $form->textField($model,'receiver',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'udhdata'); ?>
                <?php echo $form->textField($model,'udhdata'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'msgdata'); ?>
                <?php echo $form->textArea($model,'msgdata',array('rows'=>6, 'cols'=>50)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'time'); ?>
                <?php echo $form->textField($model,'time'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'smsc_id'); ?>
                <?php echo $form->textField($model,'smsc_id',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'service'); ?>
                <?php echo $form->textField($model,'service',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'account'); ?>
                <?php echo $form->textField($model,'account',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'sms_type'); ?>
                <?php echo $form->textField($model,'sms_type',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'mclass'); ?>
                <?php echo $form->textField($model,'mclass',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'mwi'); ?>
                <?php echo $form->textField($model,'mwi',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'coding'); ?>
                <?php echo $form->textField($model,'coding',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'compress'); ?>
                <?php echo $form->textField($model,'compress',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'validity'); ?>
                <?php echo $form->textField($model,'validity',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'deferred'); ?>
                <?php echo $form->textField($model,'deferred',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'dlr_mask'); ?>
                <?php echo $form->textField($model,'dlr_mask',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'dlr_url'); ?>
                <?php echo $form->textField($model,'dlr_url',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'pid'); ?>
                <?php echo $form->textField($model,'pid',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'alt_dcs'); ?>
                <?php echo $form->textField($model,'alt_dcs',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'rpi'); ?>
                <?php echo $form->textField($model,'rpi',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'charset'); ?>
                <?php echo $form->textField($model,'charset',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'boxc_id'); ?>
                <?php echo $form->textField($model,'boxc_id',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'binfo'); ?>
                <?php echo $form->textField($model,'binfo',array('size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'campaign_id'); ?>
                <?php echo $form->textField($model,'campaign_id'); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
