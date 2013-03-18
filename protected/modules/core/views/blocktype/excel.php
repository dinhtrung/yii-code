<?php $this->pageTitle = Yii::t('app', 'Manage') . ' ' . Yii::t('blocktype', 'Blocktypes'); ?>

<?php
$this->widget('ext.widgets.excelview.EExcelView', array(
	'exportType'	=>	isset($_GET['exportType'])?($_GET['exportType']):'CSV', //Excel5|Excel2007|PDF|HTML|CSV
	'creator'	=>	Yii::app()->setting->get('Webtheme', 'siteName', Yii::app()->params['name']),
	'title'		=>	$this->pageTitle,
	'subject'	=>	$this->pageTitle,
	'dataProvider'	=>	$model->search(),
	'autoWidth'	=>	TRUE,
	/*'columns'=>array(
		'title',
		'description',
	),*/
)); ?>
