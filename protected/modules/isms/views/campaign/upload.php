<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	'Campaigns' => array(
		'index'
	) ,
	$model->title => array(
		'view',
		'id' => $model->id
	) ,
	Yii::t('isms', 'Upload') ,
);
if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Campaign', 'primaryKey' => 'id'));
?>

<h1> <?php echo Yii::t('isms', 'Upload'); ?> Campaign #<?php echo $model; ?> </h1>

<span class="note">
<?php echo Yii::t('isms', 'The following data files already associated with this campaign.'); ?>
</span>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'cpfile-grid',
	'dataProvider' => $cpfile->search() ,
	'columns' => array(
		'f.title',
		'f.description:ntext',
		'f.filename',
		'f.filemime',
		'f.filesize:number',
		array(
			"name" => 'status',
			'value'	=>	'Cpfile::statusOption($data->status)'
		),
		array(
			'class' => 'zii.widgets.grid.CButtonColumn',
			'deleteButtonUrl'=>'Yii::app()->controller->createUrl("cpfile/delete",array("id"=>$data->primaryKey))',
			'template' => '{delete}'
		) ,
	) ,
)); ?>


<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'campaign-upload-form',
	'enableAjaxValidation' => FALSE,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data'
	) ,
));
echo $form->errorSummary($model);
?>

<div class="row">
	<?php echo $form->labelEx($model, 'cpf'); ?>
	<?php echo $form->dropDownList($model, 'cpf', CHtml::listData(Datafile::model()->findAll(), 'fid', 'filename', 'title'), array('multiple' => TRUE)); ?>
	<?php echo $form->error($model, 'cpf'); ?>
	<p class="hint"><?php if ('_HINT_Campaign.cpf' != $hint = Yii::t('isms', '_HINT_Campaign.cpf')) echo $hint; ?></p>
</div>

<div class="row">
	<?php echo $form->labelEx($model, 'datafiles'); ?>
	<?php $this->widget('CMultiFileUpload', array(
	'model' => $model,
	'attribute' => 'datafiles',
	'accept' => 'txt|csv|zip',
	'options' => array() ,
)); ?>
	<?php echo $form->error($model, 'datafiles'); ?>
	<p class="hint"><?php if ('_HINT_Campaign.datafiles' != $hint = Yii::t('isms', '_HINT_Campaign.datafiles')) echo $hint; ?></p>
</div>


<?php
echo CHtml::Button(Yii::t('isms', 'Cancel') , array(
	'submit' => array(
		'campaign/admin'
	)
));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
