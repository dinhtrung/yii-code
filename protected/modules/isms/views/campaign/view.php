<?php
if (! Yii::app()->getUser()->checkAccess('Isms.Campaign.Admin')  && ! Yii::app()->getUser()->checkAccess('Isms.Sendsms.*') && ! Yii::app()->getUser()->checkAccess('Isms.Sentsms.*')
//  && ($model->cporders->o->userid != UserModule::user()->getId()

){
	foreach ($model->cporders as $order){
		if ($order->o->userid != UserModule::user()->getId()) throw new CHttpException(404);
	}
}
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms', 'Campaigns') => array( 'index' ) ,
	$this->pageTitle = $model->title,
);
if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Campaign', 'primaryKey' => 'id'));


$model->sent = $model->getSent();
$model->send = $model->getSend();
$model->blocksent = $model->getBlocksent();
$model->blocksend = $model->getBlocksend();
?>

<h1><?php echo $pageTitle = $model; ?></h1>

<p class="box">
	<?php echo CHtml::encode($model->description); ?>
</p>

<?php $this->beginClip('basic');
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'owner:text',
		'codename',

		array(
			'name' => 'throughput',
			'value'	=>	Campaign::throughputOption($model->throughput),
			'type'	=>	'html',
		),
		array(
			'name' => 'priority',
			'value'	=>	Campaign::priorityOption($model->priority),
			'type'	=>	'html',
		),
		// ISTT: All flags goes here...
		array(
				'name' => 'status',
				'value'	=>	Campaign::statusOption($model->status),
				'type'	=>	'html',
		),
		array(
				'name' => 'ready',
				'value'	=>	Campaign::readyOption($model->ready),
				'type'	=>	'html',
		),
		array(
			'name' => 'approved',
			'value'	=>	Campaign::approvedOption($model->approved),
			'type'	=>	'html',
		),
		array(
			'name' => 'finished',
			'value'	=>	($model->finished && ($model->end < date("Y-m-d H:i:s", time())))?Campaign::finishedOption(1):Campaign::finishedOption($model->finished),
			'type'	=>	'html',
		),
		array(
			'name' => 'limit_exceeded',
			'value'	=>	Campaign::limit_exceededOption($model->limit_exceeded),
			'type'	=>	'html',
		),
		array(
			'name' => 'active',
			'value'	=>	Campaign::activeOption($model->active),
			'type'	=>	'html',
		),
		'smsimport:number',
		'blockimport:number',

		'send:number',
		'blocksend:number',

		'sent:number',
		'blocksent:number',
	) ,
));
$cporder = new Cporder('search');
$cporder->cid = $model->id;
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'cporder-grid',
	'template'=>"{summary}\n{items}\n{pager}",
	'dataProvider' => $cporder->search() ,
	'summaryText' => 'Đơn hàng cấp cho chương trình',
	'columns' => array(
		'o.title',
		array('header' => 'Số block tin tính cho đơn hàng', 'value' => '$data->smsblock', 'type' => 'number'),
	) ,
));
$this->endClip(); ?>



<?php $this->beginClip('template'); ?>
<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'sender',
		'col',
		'isdncol',
		'template',
	) ,
));
$this->endClip(); ?>
<?php $this->beginClip('filter');
$filter = new Cpfilter('search'); $filter->cid = $model->getPrimaryKey();
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'acceptfilter-grid',
	'template'=>"{items}\n{pager}\n{summary}",
	'dataProvider' => $filter->search(),
	'filter'	=>	$filter,
	'columns' => array(
		array(
			'name' => 'f',
			'header' => Yii::t('isms', 'Filters') ,
			'value' => 'CHtml::link($data->f->title, array("filter/view", "id" => $data->fid))',
			'type' => 'html',
		) ,
		array(
			'name' => 'type',
			'header' => Yii::t('isms', 'Type') ,
			'value' => 'Cpfilter::typeOption($data->type)',
		) ,
	) ,
)); ?>
<?php $this->endClip(); ?>


<?php $this->beginClip('files');
$cpfile = new Cpfile('search');
$cpfile->cid = $model->id;
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'cpfile-grid',
	'template'=>"{items}\n{pager}\n{summary}",
	'dataProvider' => $cpfile->search() ,
	'columns' => array(
		'f.download:html',
		'f.filesize:number',
		array('header' => 'Số dòng ước tính', 'value' => 'round($data->f->filesize/13)', 'type' => 'number'),
		array(
			'name' => 'f.status',
			'value' => 'Cpfile::statusOption($data->status)',
			'type' => 'raw',
		),
	) ,
)); ?>
<?php $this->endClip(); ?>


<?php $this->beginClip('info');

$cpworktimes = new Cpworktime('search');
$cpworktimes->cid = $model->id;
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'cpworktimes-grid',
	'template'=>"{items}\n{pager}\n{summary}",
	'dataProvider' => $cpworktimes->search() ,
	'columns' => array(
		array(
			'name' => 'Start Hour',
			'value' => '$data->t->start',
			'type' => 'raw',
		),
		array(
			'name' => 'End Hour',
			'value' => '$data->t->end',
			'type' => 'raw',
		)

	) ,
));

$cpworkday = '';
$model->cpworkday = str_split($model->cpworkday);
foreach ($model->cpworkday as $day) $cpworkday .= '<li>'.Campaign::cpweekdayOption($day).'</li>';
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'createtime:datetime',
		'updatetime:datetime',
		'request_date',
		'request_owner',
		'datasender',
		'tosubscriber',
		'start',
		'end',
		array(
			'name' => 'cpworkday',
			'value' => '<ul>' . $cpworkday . '</ul>',
			'type'	=>	'html',
		),
	)
));
$this->endClip(); ?>

<?php $this->beginClip('send');
$sendSms = new Sendsms('search');	$sendSms->campaign_id = $model->getPrimaryKey();
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'send-sms-grid',
	'dataProvider' => $sendSms->search() ,
	'filter'	=>	$sendSms,
	'columns' => array(
		'time',
		'sender',
		'receiver',
		array('name' => 'msgdata', 'value' => 'urldecode($data->msgdata)', 'type' => 'html'),
	) ,
));
$this->endClip();


$this->beginClip('sent');
$sentSms = new Sentsms('search');
$sentSms->campaign_id = $model->getPrimaryKey();
$sentSms->dlr = 1;
echo "Tin nhan gui thanh cong.";
$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'sent-sms-grid',
		'dataProvider' => $sentSms->search() ,
		'filter'	=>	$sentSms,
		'columns' => array(
			'time',
			'sender',
			'receiver',
			array('name' => 'msgdata', 'value' => 'urldecode($data->msgdata)', 'type' => 'raw'),
		//	'dlr',
		) ,
	));

$dlr0 = new Sentsms('search');
$dlr0->campaign_id = $model->getPrimaryKey();
$dlr0->dlr = 0;
echo "Tin nhan khong gui duoc";
$this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'dlr0-sms-grid',
                'dataProvider' => $dlr0->search() ,
                'filter'        =>      $dlr0,
                'columns' => array(
                        'time',
                        'sender',
                        'receiver',
                        array('name' => 'msgdata', 'value' => 'urldecode($data->msgdata)', 'type' => 'raw'),
                //      'dlr',
                ) ,
        ));
$this->endClip(); ?>


<?php
$tabs = array(
	    'basic'=>array(
	          'title'	=>	Yii::t('isms', 'Basic'),
	          'content'	=> $this->clips['basic']
	    ),
	    'info'=>array(
	          'title'	=>	Yii::t('isms', 'Information'),
	          'content'	=> $this->clips['info']
	    ),
	    'template'=>array(
	          'title'	=>	Yii::t('isms', 'SMS Template'),
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
	);
$accessSend = TRUE;
foreach ($model->cpf as $file){
	if ($file->f->uid != UserModule::user()->getId()){
		$accessSend = FALSE;
		break;
	}
}
if (Yii::app()->getUser()->checkAccess('Isms.Sendsms.Admin') // User cap admin hoac manager
	OR
	$accessSend
)
$tabs['send']=array(
		          'title'	=>	Yii::t('isms', 'Send SMS'),
		          'content'	=> $this->clips['send']
		);
if (Yii::app()->getUser()->checkAccess('Isms.Sentsms.Admin') OR $accessSend)
$tabs['sent']=array(
		          'title'	=>	Yii::t('isms', 'Sent SMS'),
		          'content'	=> $this->clips['sent']
		);
$this->widget('CTabView', array(
	'tabs' => $tabs
)); ?>
