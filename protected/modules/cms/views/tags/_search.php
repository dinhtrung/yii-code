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
                <?php echo $form->label($model,'name'); ?>
                <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'frequency'); ?>
                <?php echo $form->textField($model,'frequency'); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('cms', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->