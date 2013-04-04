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
	'size' => 20,
	'maxlength' => 20
)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model, 'reply_refuse'); ?>
                <?php echo $form->textField($model, 'reply_refuse', array(
	'size' => 60,
	'maxlength' => 256
)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model, 'reply_accept'); ?>
                <?php echo $form->textField($model, 'reply_accept', array(
	'size' => 60,
	'maxlength' => 256
)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model, 'reply_false_syntax'); ?>
                <?php echo $form->textField($model, 'reply_false_syntax', array(
	'size' => 60,
	'maxlength' => 256
)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model, 'description'); ?>
                <?php echo $form->textField($model, 'description', array(
	'size' => 60,
	'maxlength' => 256
)); ?>
        </div>


        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('isms', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
