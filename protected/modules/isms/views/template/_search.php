<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route) ,
	'method' => 'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model, 'id'); ?>
                <?php echo $form->textField($model, 'id'); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model, 'title'); ?>
                <?php echo $form->textField($model, 'title', array(
	'size' => 40,
	'maxlength' => 40
)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model, 'body'); ?>
                <?php echo $form->textArea($model, 'body', array(
	'rows' => 6,
	'cols' => 50
)); ?>
        </div>
    
        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('isms', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
