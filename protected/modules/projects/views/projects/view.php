<?php
/* @var $this ProjectsController */
/* @var $model Projects */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Projects', 'url'=>array('index')),
	array('label'=>'Create Projects', 'url'=>array('create')),
	array('label'=>'Update Projects', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Projects', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Projects', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Projects :title Details', array(':title' => $model->getTitle())); ?></h1>

<div class="box">
<?php $this->beginWidget('CMarkdown'); ?><?php echo $model->description; ?><?php $this->endWidget(); ?>
</div>

<?php $this->beginClip('projects')?>
<?php
$model->priority  = $this->widget("CStarRating",array("model" => $model, "attribute" => 'priority', 'starCount'	=> 5, "readOnly" => TRUE), TRUE);
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'alias',
		'target_budget:number',
		'actual_budget:number',
		'start_date',
		'end_date',
		'priority:raw',
		'private',
		'status:boolean',
		'percent_complete',
		'department',
		'url',
		'demo_url',
		'au.link:html',
		'ed.link:html',
		'ow.link:html',
		'createtime:datetime',
		'updatetime:datetime',
	),
)); ?>
<?php $this->endClip();?>

<?php $this->beginClip('contacts'); ?>
<?php
$pj = new ProjectContact('search');
$pj->pid = $model->getPrimaryKey();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'departments-grid',
	'dataProvider'=>$pj->search(),
	'columns'=>array(
		'contact.title',
	),
)); ?>
<?php $this->endClip(); ?>

<?php $this->beginClip('departments'); ?>
<?php
$pj = new ProjectDepartment('search');
$pj->pid = $model->getPrimaryKey();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'departments-grid',
	'dataProvider'=>$pj->search(),
	'columns'=>array(
		'department.title',
		'department.description:ntext',
	),
)); ?>
<?php $this->endClip(); ?>


<?php $this->beginClip('events'); ?>
<?php
$events = new Events('search');
$events->pid = $model->getPrimaryKey();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'departments-grid',
	'dataProvider'=>$events->search(),
	'columns'=>array(
		'department.title',
		'department.description:ntext',
	),
)); ?>
<?php $this->endClip(); ?>


<?php
$this->widget("CTabView", array(
	"tabs"	=>	array(
	    "projects"=>array(
	          "title"	=>	Yii::t("app", "Projects"),
	          "content"	=>	$this->clips["projects"],
	    ),
	    "contacts"=>array(
	          "title"	=>	Yii::t("app", "Contacts"),
	          "content"	=>	$this->clips["contacts"],
	    ),
	    "departments"=>array(
	          "title"	=>	Yii::t("app", "Departments"),
	          "content"	=>	$this->clips["departments"],
	    ),
	    "events"=>array(
	          "title"	=>	Yii::t("app", "Events"),
	          "content"	=>	$this->clips["events"],
	    ),
	)
));
?>