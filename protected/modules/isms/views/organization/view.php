<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('app', 'Organizations') => array( 'index' ) ,
	$model->title,
);
$this->renderPartial('_menu');
?>

<h1><?php echo $pageTitle = $model; ?></h1>

<p class="box"><?php echo $model->description; ?></p>
<code>
			bearerbox_id=<?php echo $model->id; ?>
</code>

<div>
<h2><?php echo Yii::t('app', 'Users belongs to this organization'); ?></h2>
<?php $users = new User('search'); $users->org = $model->getPrimaryKey(); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$users->search(),
	'filter'	=>	$users,
	'columns'=>array(
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->email), "mailto:".$data->email)',
		),
		'createtime:datetime',
		'lastvisit:datetime',
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
		),
		array(
			'name'=>'role',
			'value'=>'Yii::t("rights", $data->role, array(), "dbmessages")',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>

<div>
<h2><?php echo Yii::t('app', 'Campaigns belongs to this organization'); ?></h2>
<?php $campaigns = new Campaign('search'); $campaigns->org = $model->getPrimaryKey(); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$campaigns->search(),
	'filter'	=>	$campaigns,
	'columns'=>array(
		'title',
		'description',
		'codename',
		'start',
		'end',
	),
)); ?>
</div>