<?php

$this->widget('ext.widgets.excelview.EExcelView', array(
	'id'=>'nodeImage-grid',
	'dataProvider'=>$model->search(),
	'creator' => Yii::app()->setting->get("theme", "siteName"),
	'title'	 => $this->pageTitle,
	'subject' => '',
	'description' => '',
	'autoWidth' => TRUE,
	'exportType' => 'Excel2007',// - the type of the export, all possible types of PHPExcel lib(Excel5, Excel2007,PDF, HTML)
    'disablePaging' => TRUE, // - if set to true, it will export all data (default true)
    'filename' => null, // - the full path of the filename to export to. If null it will stream to the browser
	'columns'=>array(
		'title',
		'body:raw',
		'createtime:datetime',
		'updatetime:datetime',
	),
));
