<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'campaign-form',
		'enableAjaxValidation'=>true,
		'htmlOptions' => array(
				'enctype' => 'multipart/form-data'
		) ,
	));
	echo $form->errorSummary($model);
	$this->widget('ext.widgets.multiselect.EMultiSelect', array(
			'sortable'	=>	TRUE,
			'searchable'	=>	TRUE,
	));
?>

<?php $this->beginClip('basic'); ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'title'); ?>
			<?php echo $form->textField($model, 'title', array( 'size' => 40, 'maxlength' => 40 )); ?>
		<?php echo $form->error($model, 'title'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'Type a name for this campaign.'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'description'); ?>
		<?php echo $form->textArea($model, 'description', array( 'rows' => 6, 'cols' => 50 )); ?>
		<?php echo $form->error($model, 'description'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'A brief description for this campaign'); ?></p>
	</div>


	<div class="row">
	<?php
$cporders = array();
foreach ($model->cporders as $r) {
	$cporders[] = $r->oid;
}
$model->cporders = $cporders;
?>
		<?php echo $form->labelEx($model, 'cporders'); ?>
		<?php if ($org = UserModule::user()->org){
			if (Yii::app()->getUser()->checkAccess('Isms.Campaign.*'))	// For Manager...
			$values =  CHtml::listData(
					Smsorder::model()->with('user')->findAll(
						't.status=:status AND t.expired >= :expired AND user.org = :org',
						array(':status' => Smsorder::STATUS_TRUE, ':expired' => date('Y-m-d H:i:s'), ':org' => $org)
					), 'id', 'selectTitle');
			else $values = CHtml::listData(
                                        Smsorder::model()->findAll(
                                                't.status=:status AND t.expired >= :expired AND t.userid = :org',
                                                array(':status' => Smsorder::STATUS_TRUE, ':expired' => date('Y-m-d H:i:s'), ':org' => UserModule::user()->getId())
                                        ), 'id', 'selectTitle');

				} else $values = CHtml::listData(
					Smsorder::model()->with('user')->findAll(
						't.status=:status AND t.expired >= :expired AND user.org != 0',
						array(':status' => Smsorder::STATUS_TRUE, ':expired' => date('Y-m-d H:i:s'))
					), 'id', 'selectTitle');
		echo $form->dropDownList($model, 'cporders',
				$values, array('multiple' => TRUE, 'class' => 'multiselect')); ?>
		<?php echo $form->error($model, 'cporders'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'Choose the account associated with this campaign.'); ?></p>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model, 'codename'); ?>
		<?php echo $form->textField($model, 'codename', array( 'size' => 20, 'maxlength' => 20 )); ?>
		<?php echo $form->error($model, 'codename'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'Enter the Code for this campaign. This should be unique per organization'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'status'); ?>
		<?php echo $form->dropDownList($model, 'status', Campaign::statusOption()); ?>
		<?php echo $form->error($model, 'status'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Change to Disable to temporary stop the campaign.'); ?></p>
	</div>

	<?php if (Yii::app()->getUser()->checkAccess('Isms.Campaign.Approved')): ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'approved'); ?>
		<?php echo $form->dropDownList($model, 'approved', Campaign::approvedOption()); ?>
		<?php echo $form->error($model, 'approved'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Only iSMS Administrators can change this field. Users can declare their own campaigns, but have to wait for approval.'); ?></p>
	</div>
	<?php endif; ?>
	<?php if (Yii::app()->getUser()->checkAccess('Isms.Campaign.Reset')): ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'finished'); ?>
		<?php echo $form->dropDownList($model, 'finished', Campaign::finishedOption()); ?>
		<?php echo $form->error($model, 'finished'); ?>
		<p class="hint"><?php echo Yii::t('app', 'This bit is set when a campaign finish sending. Only administration can reset a campaign.'); ?></p>
	</div>
	<?php endif; ?>

	<?php if (Yii::app()->getUser()->checkAccess('Isms.Campaign.DataReset')): ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'ready'); ?>
		<?php echo $form->dropDownList($model, 'ready', Campaign::readyOption()); ?>
		<?php echo $form->error($model, 'ready'); ?>
		<p class="hint"><?php echo Yii::t('app', 'This bit is set when a campaign finish import data. Only administration can change this.'); ?></p>
	</div>
	<?php endif; ?>
	<?php if (Yii::app()->getUser()->checkAccess('Isms.Campaign.Active')): ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'active'); ?>
		<?php echo $form->dropDownList($model, 'active', Campaign::activeOption()); ?>
		<?php echo $form->error($model, 'active'); ?>
		<p class="hint"><?php echo Yii::t('app', 'This bit is set when a campaign finish sending. Only administration can reset a campaign.'); ?></p>
	</div>
	<?php endif; ?>
<?php $this->endClip(); ?>


<?php $this->beginClip('setting'); ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'throughput'); ?>
		<?php echo $form->dropDownList($model, 'throughput', Campaign::throughputOption()); ?>
		<?php echo $form->error($model, 'throughput'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Select the number of SMS to send per routine.') ?></p>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model, 'priority'); ?>
		<?php echo $form->dropDownList($model, 'priority', Campaign::priorityOption()); ?>
		<?php echo $form->error($model, 'priority'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Campaigns will be sorted by priority. Higher priority will be send first. All campaign of the same priority will be send together.') ?></p>
	</div>


<?php $this->endClip(); ?>


<?php $this->beginClip('template'); ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'sender'); ?>
		<?php echo $form->textField($model, 'sender', array( 'size' => 20, 'maxlength' => 20 )); ?>
		<?php echo $form->error($model, 'sender'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'Enter a Sender for this campaign. Every message in this campaign will have this sender.'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'col'); ?>
		<?php echo $form->textField($model, 'col', array('size' => 5)); ?>
		<?php echo $form->error($model, 'col'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Number of columns in the data files. Always bigger than ISDN column below.'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'isdncol'); ?>
		<?php echo $form->textField($model, 'isdncol', array('size' => 5)); ?>
		<?php echo $form->error($model, 'isdncol'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Order of the ISDN column in the data files.'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'template'); ?>
		<?php echo $form->textArea($model, 'template', array( 'rows' => 6, 'cols' => 50 )); ?>
		<?php echo $form->error($model, 'template'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Hãy nhập mẫu tin nhắn sẽ gửi cho khách hàng. Có thể dùng chuỗi <code>{isdn}</code> nếu cần chèn số điện thoại người nhận vào tin nhắn. Ngoài ra, cũng có thể nhập <code>{csv<strong>n</strong>}</code> để chèn dữ liệu trong cột thứ <strong>n</strong> vào tin nhắn gửi đi.'); ?></p>
		<p class="red">Số ký tự: <ins id="charcnt"><?php echo strlen($model->template); ?></ins> ký tự...</p>
	</div>

	<div class="row">
		<p class="note"><?php echo Yii::t('app', 'The following fields used for receive and change the SMS Template through Email.')?></p>
		<p class="note"><?php echo Yii::t('app', 'The system will check for Email with Subject and Attachment file specified below. The content of the attachment will be extract and add into the SMS Template of this campaign. The data files will be reload. Then the campaign will be run.')?></p>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model, 'emailbox'); ?>
		<?php echo $form->dropDownList($model,'emailbox',
			array(NULL => Yii::t('isms', '--- Choose Email Server Configuration ---')) + CHtml::listData(Emailsetting::model()->findAll(), 'id', 'email', 'hostname'));?>
		<?php echo $form->error($model, 'emailbox'); ?>
		<p class="hint"><?php if ('_HINT_Campaign.emailbox' != $hint = Yii::t('isms', '_HINT_Campaign.emailbox')) echo $hint; ?></p>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model, 'esubject'); ?>
		<?php echo $form->textField($model,'esubject');?>
		<?php echo $form->error($model, 'esubject'); ?>
		<p class="hint"><?php if ('_HINT_Campaign.esubject' != $hint = Yii::t('isms', '_HINT_Campaign.esubject')) echo $hint; ?></p>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model, 'eattachment'); ?>
		<?php echo $form->textField($model,'eattachment');?>
		<?php echo $form->error($model, 'eattachment'); ?>
		<p class="hint"><?php if ('_HINT_Campaign.eattachment' != $hint = Yii::t('isms', '_HINT_Campaign.eattachment')) echo $hint; ?></p>
	</div>
<?php $this->endClip(); ?>


<?php $this->beginClip('filter'); ?>
<?php $filterOptions = CHtml::listData(Filter::model()->findAll() , 'id', 'title');
$model->acceptFilters = array();
$model->denyFilters = array();
foreach ($model->filters as $r) {
	if ($r->type) $model->acceptFilters[] = $r->fid;
	else $model->denyFilters[] = $r->fid;
}
?>
<div class="row">
	<?php echo $form->labelEx($model, 'acceptFilters'); ?>
	<?php echo $form->dropDownList($model, 'acceptFilters', $filterOptions, array('multiple' => TRUE, 'class' => 'multiselect')); ?>
		<?php echo $form->error($model, 'acceptFilters'); ?>
		<p class="hint"><?php if ('_HINT_Campaign.acceptFilters' != $hint = Yii::t('isms', '_HINT_Campaign.acceptFilters')) echo $hint; ?></p>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model, 'denyFilters'); ?>
		<?php echo $form->dropDownList($model, 'denyFilters', $filterOptions, array('multiple' => TRUE, 'class' => 'multiselect')); ?>
		<?php echo $form->error($model, 'denyFilters'); ?>
		<p class="hint"><?php if ('_HINT_Campaign.denyFilters' != $hint = Yii::t('isms', '_HINT_Campaign.denyFilters')) echo $hint; ?></p>
	</div>
<?php $this->endClip(); ?>


<?php $this->beginClip('files'); ?>
	<?php	if ($model->id){
		$cpfile = new Cpfile('search');
		$cpfile->cid = $model->getPrimaryKey();
		$this->widget('zii.widgets.grid.CGridView',
			array(
				'id' => 'cpfile-grid',
				'dataProvider' => $cpfile->search() ,
				'columns' => array(
					'f.title',
					'f.description:ntext',
					'f.filename',
					'f.filemime',
					'f.filesize:number',
					array(	"name" => 'status',	'value'	=>	'Cpfile::statusOption($data->status)', 'type' => 'html'),
					array(
						'class' => 'zii.widgets.grid.CButtonColumn',
						'deleteButtonUrl'=>'Yii::app()->controller->createUrl("cpfile/delete",array("id"=>$data->primaryKey))',
						'template' => '{delete}'
		) ,			) ,
		));
}	?>
<div class="hide">
		<?php echo $form->labelEx($model, 'cpf'); ?>		<?php echo $form->dropDownList($model, 'cpf', CHtml::listData(Datafile::model()->findAll(), 'fid', 'filename'), array('multiple' => TRUE, 'class' => 'multiselect', )); ?>		<?php echo $form->error($model, 'cpf'); ?>		<p class="hint"><?php echo Yii::t('app', 'Choose an existed files to re-use.') ?></p>	</div>
	<div class="row">
		<?php echo $form->labelEx($model, 'datafiles'); ?>
			<?php $this->widget('CMultiFileUpload', array(
				'model' => $model,
				'attribute' => 'datafiles',
				'accept' => 'txt|csv|zip',
				'options' => array() ,
			)); ?>
		<?php echo $form->error($model, 'datafiles'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Upload one or more files to this campaign.'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'ftpserver'); ?>
		<?php echo $form->dropDownList($model,'ftpserver',
			array(NULL => Yii::t('isms', '--- Choose FTP Server Configuration ---')) + CHtml::listData(Ftpsetting::model()->findAll(), 'id', 'username', 'hostname'));?>
		<?php echo $form->error($model, 'ftpserver'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'Select the FTP Connection this campaign should use to retrieve extra data files.'); 	?></p>
	</div>

	<div class="row">
		<?php   $ftpfilenames = array();
				if (is_array($model->ftpfilenames))
				foreach ($model->ftpfilenames as $ftpfile)
					if ($ftpfile->status == Ftpfilename::STATUS_NEW) $ftpfilenames[] = $ftpfile->filename;
				$model->ftpfilenames = implode("\n", $ftpfilenames);
		?>
		<?php echo $form->labelEx($model, 'ftpfilenames'); ?>
		<?php echo $form->textArea($model,'ftpfilenames');?>
		<?php echo $form->error($model, 'ftpfilenames'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Enter the name of files to retrieve from FTP Connection.'); ?></p>
	</div>
<?php $this->endClip(); ?>


<?php $this->beginClip('info'); ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'request_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'request_date',
			'htmlOptions' => array(
				'size' => 10,
				'style' => 'width:80px !important'
			) ,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
			) ,
		));; ?>
		<?php echo $form->error($model, 'request_date'); ?>
		<p class="hint"><?php echo Yii::t('app', 'The day this campaign is requested?'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'request_owner'); ?>
		<?php echo $form->textField($model, 'request_owner', array( 'size' => 40, 'maxlength' => 40 )); ?>
		<?php echo $form->error($model, 'request_owner'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Who request this campaign?'); ?></p>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model, 'datasender'); ?>
		<?php echo $form->textField($model, 'datasender', array( 'size' => 60, 'maxlength' => 80 )); ?>
		<?php echo $form->error($model, 'datasender'); ?>
		<p class="hint"><?php echo Yii::t('app', 'Who provide data for this campaign?'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'tosubscriber'); ?>
		<?php echo $form->textArea($model, 'tosubscriber', array( 'rows' => 6, 'cols' => 50 )); ?>
		<?php echo $form->error($model, 'tosubscriber'); ?>
		<p class="hint"><?php echo Yii::t('app', 'SMS will be send to who?'); ?></p>
	</div>


<?php $this->endClip(); ?>

<?php $this->beginClip('expiration'); ?>
	<div class="row">
	<?php echo $form->labelEx($model, 'start'); ?>
	<?php
	//echo $form->textField($model,'start');
	$this->widget('ext.widgets.datetimepicker.CJuiDateTimePicker', array(
		'model' => $model,
		'attribute' => 'start',
		'htmlOptions' => array(
			'size' => 16
		) ,
		'options' => array(
			'showButtonPanel' => true,
			'changeYear' => true,
			'dateFormat' => 'yy-mm-dd',
		) ,
	));; ?>
	<?php echo $form->error($model, 'start'); ?>
	<p class="hint"><?php if ('_HINT_Campaign.start' != $hint = Yii::t('isms', '_HINT_Campaign.start')) echo $hint; ?></p>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model, 'end'); ?>
	<?php $this->widget('ext.widgets.datetimepicker.CJuiDateTimePicker', array(
		'model' => $model,
		'attribute' => 'end',
		'htmlOptions' => array(
			'size' => 16
		) ,
		'options' => array(
			'showButtonPanel' => true,
			'changeYear' => true,
			'dateFormat' => 'yy-mm-dd',
		) ,
	));; ?>
	<?php echo $form->error($model, 'end'); ?>
	<p class="hint"><?php if ('_HINT_Campaign.end' != $hint = Yii::t('isms', '_HINT_Campaign.end')) echo $hint; ?></p>
	</div>
<?php
$model->cpworktimes = array();
foreach ($model->worktimes as $r) {
	$model->cpworktimes[] = $r->getPrimaryKey();
}
?>
	<div class="row">
		<?php echo $form->labelEx($model, 'cpworktimes'); ?>
		<?php echo $form->dropDownList($model, 'cpworktimes', CHtml::listData(Worktime::model()->findAll(), 'id', 'time'), array('multiple' => TRUE, 'class' => 'multiselect')); ?>
		<?php echo $form->error($model, 'cpworktimes'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'Choose which time this campaign should be active.'); ?></p>
	</div>

<?php
if (is_string($model->cpworkday)) $model->cpworkday = str_split($model->cpworkday);
?>
	<div class="row">
		<?php echo $form->labelEx($model, 'cpworkday'); ?>
		<?php echo $form->checkBoxList($model, 'cpworkday', Campaign::cpweekdayOption(), array( 'labelOptions' => array( 'style' => 'display:inline' ))); ?>
		<?php echo $form->error($model, 'cpworkday'); ?>
		<p class="hint"><?php echo Yii::t('isms', 'Choose the day of the weeks this campaign should be running.'); ?></p>
	</div>
<?php $this->endClip(); ?>


<?php $this->widget('CTabView', array(
	'tabs' => array(
	    'basic'=>array(
	          'title'	=>	Yii::t('isms', 'Basic') . '<span class="required">*</span>',
	          'content'	=> $this->clips['basic']
	    ),
	    'info'=>array(
	          'title'	=>	Yii::t('isms', 'Information'),
	          'content'	=> $this->clips['info']
	    ),
	    //'setting'=>array(
	    //      'title'	=>	Yii::t('isms', 'Settings') . '<span class="required">*</span>',
	    //      'content'	=> $this->clips['setting']
	    //),
	    'template'=>array(
	          'title'	=>	Yii::t('isms', 'SMS Template') . '<span class="required">*</span>',
	          'content'	=> $this->clips['template']
	    ),
	    'filter'=>array(
	          'title'	=>	Yii::t('isms', 'Filters'),
	          'content'	=> $this->clips['filter']
	    ),
	    'files'=>array(
	          'title'	=>	Yii::t('isms', 'Files'),
	          'content'	=> $this->clips['files']
	    ),

		'expiration'=>array(
		          'title'	=>	Yii::t('isms', 'Expiration') . '<span class="required">*</span>',
		          'content'	=> $this->clips['expiration']
		),
	)
)); ?>

<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => array('campaign/admin')));
echo CHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->

<script type="text/javascript">
$(document).ready(function(){
	$("#Campaign_template").keyup(function(){
		$("#charcnt").html($(this).val().length);
	});
});
</script>
