<?php
$this->breadcrumbs=array(
	'Đơn hàng'=>array('index'),
	$model->title,
);

$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Chi tiết đơn hàng <em>:title</em>', array(':title' => $model->title)); ?></h1>

<?php
$this->beginClip('basic');
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'description',
		array('name' => 'status', 'value' => Smsorder::statusOption($model->status)),
		'createtime:datetime',
		'updatetime:datetime',
		array('name' => 'userid', 'value' => $model->user->username),
		'expired',
		'smscount:number',
		'smsleft:number',
	),
));
$this->endClip();
?>

<?php
$this->beginClip('campaign');
$campaigns = new Cporder("search");
$campaigns->oid = $model->getPrimaryKey();
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$campaigns->search(),
	'columns'=>array(
		'c.title',
		'c.description',
		'c.codename',
		'c.start',
		'c.status:boolean',
		'c.end',
		'c.blockimport:number',
	),
));
$this->endClip();
?>


<?php
$this->widget('CTabView', array(
	'tabs'	=>	array(
	    'basic'=>array(
	          'title'	=>	Yii::t('isms', 'Thông tin đơn hàng'),
	          'content'	=>	$this->clips['basic'],
	    ),
	    'campaign'=>array(
	          'title'	=>	Yii::t('isms', 'Chương trình thuộc đơn hàng này'),
	          'content'	=>	$this->clips['campaign'],
	    ),
	)
));
?>
