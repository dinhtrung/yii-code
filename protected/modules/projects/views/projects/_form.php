<?php
/* @var $this ProjectsController */
/* @var $model Projects */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projects-form',
	'enableAjaxValidation'=>false,
));
// Them class=multiselect cho CHtml::dropDownList() de su dung plugin nay
$this->widget('ext.widgets.multiselect.EMultiSelect', array(
		'sortable'	=>	TRUE,
		'searchable'	=>	TRUE,
));

?>

	<p class="note"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

<?php $this->beginClip("projects"); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Tên dự án'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Mô tả cho dự án này'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'alias'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Tên thu gọn của dự án.'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'target_budget'); ?>
		<?php echo $form->textField($model,'target_budget'); ?>
		<?php echo $form->error($model,'target_budget'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Giá trị ước tính'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'actual_budget'); ?>
		<?php echo $form->textField($model,'actual_budget'); ?>
		<?php echo $form->error($model,'actual_budget'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Giá trị thực tế'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'start_date',
			'htmlOptions' => array(
				'size' => 10,
				'style' => 'width:80px !important'
			) ,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
			) ,
		)); ?>
		<?php echo $form->error($model,'start_date'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Ngày bắt đầu ước tính'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'end_date',
			'htmlOptions' => array(
				'size' => 10,
				'style' => 'width:80px !important'
			) ,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
			) ,
		)); ?>
		<?php echo $form->error($model,'end_date'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Ngày kết thúc ước tính'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php $this->widget('CStarRating',array(
			'model'		=>	$model,
			'attribute'		=>	'priority',
			'titles' 	=> 	array(),
			'allowEmpty'=>	FALSE,
			'starCount'	=> 5
		)); ?><br>
		<?php echo $form->error($model,'priority'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Mức ưu tiên'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->checkBox($model,'private'); ?>
		<?php echo $form->labelEx($model,'private'); ?>
		<?php echo $form->error($model,'private'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Trạng thái của dự án. @TODO: ĐỊnh nghĩa các trạng thái của dự án này.'); ?></p>
	</div>
<?php /**
	<div class="row">
		<?php echo $form->labelEx($model,'percent_complete'); ?>
		<?php echo $form->textField($model,'percent_complete'); ?>
		<?php echo $form->error($model,'percent_complete'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

*/?>
	<div class="row">
		<?php echo $form->labelEx($model,'department'); ?>
		<?php echo $form->checkBoxList($model,'department',
				CHtml::listData(Departments::model(), 'id', 'title')
			); ?>
		<?php echo $form->error($model,'department'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Phòng ban quản lý dự án này'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'demo_url'); ?>
		<?php echo $form->textField($model,'demo_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'demo_url'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'owner'); ?>
		<?php echo $form->textField($model,'owner'); ?>
		<?php echo $form->error($model,'owner'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

<?php $this->endClip(); ?>

<?php $this->beginClip("contacts");
// 	$tmp = array();
// 	foreach ($model->contacts as $k => $v) $tmp[$k] = $v->cid;
// 	$model->contacts = $tmp;
	CVarDumper::dump($model->contacts, 10, TRUE);
?>
	<div class="row">
		<?php echo $form->labelEx($model, 'Contacts'); ?>
		<?php echo $form->dropDownList($model, 'contacts',
				CHtml::listData(Contacts::model()->findAll(), 'id', 'username'),
				array('multiple' => TRUE, 'class' => 'multiselect')); ?>
		<?php echo $form->error($model, 'contacts'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Danh sách người dùng tham gia vào dự án này.'); ?></p>
	</div>

<?php $this->endClip(); ?>


<?php $this->beginClip("departments"); ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'departments'); ?>
		<?php echo $form->dropDownList($model, 'departments',
				CHtml::listData(Departments::model()->findAll(), 'id', 'title'),
				array('multiple' => TRUE, 'class' => 'multiselect')); ?>
		<?php echo $form->error($model, 'departments'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Chọn danh sách các đối tác tham gia vào dự án này.'); ?></p>
	</div>

<?php $this->endClip(); ?>


<?php
$this->widget("CTabView", array(
	"tabs"	=>	array(
	    "projects"=>array(
	          "title"	=>	Yii::t("app", "Projects"),
	          "content"	=>	$this->clips["projects"],
	    ),
	    "contacts"=>array(
	          "title"	=>	Yii::t("app", "Contacts"),
	          "content"	=>	$this->clips["contacts"],
	    ),
	    "departments"=>array(
	          "title"	=>	Yii::t("app", "Departments"),
	          "content"	=>	$this->clips["departments"],
	    ),
	)
));
?>	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Save')); ?>
		<?php echo CHtml::resetButton(Yii::t('app', 'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->