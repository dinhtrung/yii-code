<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route) ,
	'method' => 'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model, 'fid'); ?>
                <?php echo $form->dropDownList($model, 'fid', CHtml::listData(Filter::model()->findAll() , 'id', 'title') , array(
	'prompt' => Yii::t('isms', 'All')
)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model, 'isdn'); ?>
                <?php echo $form->textField($model, 'isdn', array(
	'size' => 20,
	'maxlength' => 20
)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('isms', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
