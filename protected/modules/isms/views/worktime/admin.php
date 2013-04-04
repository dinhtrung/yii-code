<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('isms', 'Worktimes')
);

if(empty($this->menu))
$this->renderPartial('_menu');
		?>

<h1> <?php echo $this->pageTitle = Yii::t('isms', 'Manage') . ' ' . Yii::t('isms', 'Worktimes'); ?></h1>
<blockquote> <p> <?php echo Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?> </p> </blockquote>
<?php
$btn = array();
if (Yii::app()->getUser()->checkAccess('Isms.Worktime.Update')) $btn[] = '{update}';
if (Yii::app()->getUser()->checkAccess('Isms.Worktime.Delete')) $btn[] = '{delete}';
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'worktime-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'start',
		'end',
		array(
			'class'=>'EButtonColumnWithClearFilters',
			'template'	=>	implode(' ', $btn),
		),
	),
));

echo CHtml::endForm();
