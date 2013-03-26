<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms', 'Filters') => array( 'index' ) ,
	CHtml::encode($model),
);
if (empty($this->menu))  $this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'View') .' ' .Yii::t('isms', 'Filter') .' '. $model->title; ?></h1>


<?php
$this->beginClip('basic');
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'reply_refuse',
		'reply_accept',
		'ftpblacklist',
		'ftpblackfile',
		'ftpwhitelist',
		'ftpwhitefile',
	) ,
));
$this->endClip();
?>
<?php
$this->beginClip('syntax');
$syntax = new Syntax('search');
$syntax->fid = $model->id;
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'syntax-grid',
	'dataProvider' => $syntax->search() ,
	'filter' => $syntax,
	'columns' => array(
		'syntax',
		array('name' => 'type', 'value' => 'Syntax::typeOption($data->type)'),
	) ,
));
$this->endClip();
?>

<?php
$this->beginClip('accept');
$whitelist = new Whitelist('search');
$whitelist->fid = $model->id;
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'whitelist-grid',
	'dataProvider' => $whitelist->search() ,
	'filter' => $whitelist,
	'columns' => array(
		'isdn:ntext',
		array(
			'class' => 'zii.widgets.grid.CButtonColumn',
			'template' => '{delete}'
		) ,
	) ,
));
$this->endClip();
?>

<?php
$this->beginClip('refuse');
$blacklist = new Blacklist('search');
$blacklist->fid = $model->id;
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'blacklist-grid',
	'dataProvider' => $blacklist->search() ,
	'filter' => $blacklist,
	'columns' => array(
		'isdn:ntext',
		array(
			'class' => 'zii.widgets.grid.CButtonColumn',
			'template' => '{delete}'
		) ,
	) ,
));
$this->endClip();
?>

<?php
$this->widget('CTabView', array(
	'tabs'	=>	array(
	    'basic'=>array(
	          'title'	=>	Yii::t('isms', 'Basic Information'),
	          'content'	=>	$this->clips['basic'],
	    ),
	    'syntax'=>array(
	          'title'	=>	Yii::t('isms', 'Filter Syntax'),
	          'content'	=>	$this->clips['syntax'],
	    ),
	    'accept'=>array(
	          'title'	=>	Yii::t('isms', 'White list'),
	          'content'	=>	$this->clips['accept'],
	    ),
	    'refuse'=>array(
	          'title'	=>	Yii::t('isms', 'Black list'),
	          'content'	=>	$this->clips['refuse'],
	    ),
	)
));
?>
