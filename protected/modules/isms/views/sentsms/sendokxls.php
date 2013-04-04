<?php
$title = 'Tin đã gửi thành công'; ?>
<?php
$this->widget('ext.widgets.excelview.EExcelView', array(
	'id'=>'sentok',
	'dataProvider'=>$sentok,
	'title'=> $title,
	 'grid_mode' => 'export',
	 'exportType' => 'Excel5',
	 'creator' => 'iSMS',
	 'subject' => $title,
	 'autoWidth'=>TRUE,
	 'disablePaging' => TRUE,
	 'filename' => TextHelper::utf2ascii($title, TRUE, '-'),
	'columns'=>array(
					'campaign_id', 'sender', 'time', 'msgdata', 'cnt'
	),
)); ?>
