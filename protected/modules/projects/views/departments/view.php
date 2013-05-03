<?php
/* @var $this DepartmentsController */
/* @var $model Departments */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Departments', 'url'=>array('index')),
	array('label'=>'Create Departments', 'url'=>array('create')),
	array('label'=>'Update Departments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Departments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Departments', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Departments :title Details', array(':title' => $model->getTitle())); ?></h1>

<div class="box">
<?php $this->beginWidget('CMarkdown'); ?><?php echo $model->description; ?><?php $this->endWidget(); ?>
</div>

<?php $this->beginClip('departments'); ?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'phone',
		'fax',
		'address',
		'city',
		'state',
		'zip',
		'url:url',
		'createtime:datetime',
		'updatetime:datetime',
	),
)); ?>
<?php $this->endClip(); ?>

<?php $this->beginClip('projects'); ?>
<?php
$pj = new ProjectDepartment('search');
$pj->did = $model->getPrimaryKey();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'departments-grid',
	'dataProvider'=>$pj->search(),
	'columns'=>array(
		'project.title',
		'project.description:ntext',
	),
)); ?>
<?php $this->endClip(); ?>


<?php
$this->widget("CTabView", array(
	"tabs"	=>	array(
	    "departments"=>array(
	          "title"	=>	Yii::t("app", "Departments"),
	          "content"	=>	$this->clips["departments"],
	    ),
	    "projects"=>array(
	          "title"	=>	Yii::t("app", "Projects"),
	          "content"	=>	$this->clips["projects"],
	    ),
	)
));
?>