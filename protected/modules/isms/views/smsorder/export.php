<?php
$title = "Danh sách chương trình nhắn tin của đơn hàng ".$model->title;
$campaigns = new Cporder("search");
$campaigns->oid = $model->getPrimaryKey();
$campaigns->c->finished = Campaign::FINISHED_TRUE;
$this->widget('ext.widgets.excelview.EExcelView', array(
					 'title'=> $title,
					 'grid_mode' => 'export',
					 'exportType' => 'Excel5',
					 'creator' => 'iSMS',
					 'subject' => $title,
					 'autoWidth'=>TRUE,
					 'disablePaging' => TRUE,
					 'filename' => TextHelper::utf2ascii($title, TRUE, '-'),
					 'dataProvider'=> $campaigns->search(),
					'columns'=>array(
						'c.title',
						'c.codename',
						'c.description',
						'c.start:ntext',
						'c.end:ntext',

				'c.request_date',
				'c.request_owner',
				'c.datasender',
				'c.tosubscriber',

						array('name' => 'status', 'value' => '(string)Campaign::statusOption($data->c->status)'),
						array('name' => 'ready', 'value' => '(string)Campaign::readyOption($data->c->ready)'),
						array('name' => 'active', 'value' => '(string)Campaign::activeOption($data->c->active)'),
						array('name' => 'finished', 'value' => '(string)Campaign::finishedOption($data->c->finished)'),
						array('name' => 'approved', 'value' => '(string)Campaign::approvedOption($data->c->approved)'),
						array('name' => 'limit_exceeded', 'value' => '(string)Campaign::limit_exceededOption($data->c->limit_exceeded)'),


				'c.sender',
				'c.col',
				'c.isdncol',
				'c.template',


				'c.smsimport',
				'c.blockimport',
				'c.send',
				'c.blocksend',
				'c.sent',
				'c.blocksent',
				'smsblock',

	),
)); ?>
