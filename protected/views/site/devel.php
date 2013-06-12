<?php echo "Available ENcodings"; ?>
<?php echo implode(', ', mb_list_encodings()); ?>


<?php foreach ($dataModel as $fileName => $dataProvider):?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>$fileName . '-grid',
	'dataProvider'=>$dataProvider,
	'columns'	=>	$columns[$fileName],
)); ?>
<?php endforeach; ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=> get_class($model) . '-form',
	'htmlOptions' => array(
			'enctype' => 'multipart/form-data'
	) ,
)); ?>

	<?php echo $form->labelEx($model, 'files'); ?>
		<?php $this->widget('CMultiFileUpload', array(
			'model' => $model,
			'attribute' => 'files',
			'accept' => 'txt|csv',
			'options' => array() ,
		)); ?>
	<?php echo $form->error($model, 'files'); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'delimiter'); ?>
			<?php echo $form->textField($model, 'delimiter', array( 'size' => 2, 'maxlength' => 40 )); ?>
		<?php echo $form->error($model, 'delimiter'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'enclosure'); ?>
			<?php echo $form->textField($model, 'enclosure', array( 'size' => 2, 'maxlength' => 40 )); ?>
		<?php echo $form->error($model, 'enclosure'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'escape'); ?>
			<?php echo $form->textField($model, 'escape', array( 'size' => 2, 'maxlength' => 40 )); ?>
		<?php echo $form->error($model, 'escape'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'encode_from'); ?>
			<?php echo $form->dropDownList($model, 'encode_from', $model::encodeOptions()); ?>
		<?php echo $form->error($model, 'encode_from'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'encode_to'); ?>
			<?php echo $form->dropDownList($model, 'encode_to', $model::encodeOptions()); ?>
		<?php echo $form->error($model, 'encode_to'); ?>
	</div>
	
	<?php foreach ($tmpFiles as $k => $v) echo CHtml::hiddenField("tmpFiles[$k]", $v); ?>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Preview',array('name'=>'preview')); ?>
		<?php echo CHtml::submitButton('Import',array('name'=>'import')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->