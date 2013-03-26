<?php
$title = "Danh sách chương trình nhắn tin";
$model->finished = Campaign::FINISHED_TRUE;
$this->widget('ext.widgets.excelview.EExcelView', array(
					 'title'=> $title,
					 'grid_mode' => 'export',
					 'exportType' => 'Excel5',
					 'creator' => 'iSMS',
					 'subject' => $title,
					 'autoWidth'=>TRUE,
					 'disablePaging' => TRUE,
					 'filename' => TextHelper::utf2ascii($title, TRUE, '-'),
					 'dataProvider'=> (Yii::app()->getUser()->checkAccess('Isms.Campaign.*'))? $model->search(): $model->myCampaign(),
					'columns'=>array(
						'title',
						'codename',
						'description',
						'start:ntext',
						'end:ntext',

				'request_date',
				'request_owner',
				'datasender',
				'tosubscriber',

						array('name' => 'status', 'value' => 'Campaign::statusOption($data->status)'),
						array('name' => 'ready', 'value' => 'Campaign::readyOption($data->ready)'),
						array('name' => 'active', 'value' => 'Campaign::activeOption($data->active)'),
						array('name' => 'finished', 'value' => 'Campaign::finishedOption($data->finished)'),
						array('name' => 'approved', 'value' => 'Campaign::approvedOption($data->approved)'),
						array('name' => 'limit_exceeded', 'value' => 'Campaign::limit_exceededOption($data->limit_exceeded)'),


				'sender',
				'col',
				'isdncol',
				'template',


				'smsimport',
				'blockimport',
				'send',
				'blocksend',
				'sent',
				'blocksent',

	),
)); ?>
