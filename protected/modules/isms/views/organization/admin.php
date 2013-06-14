<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms','Organizations')
);
if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Organization')); ?>

<h1> <?php echo $this->pageTitle =  Yii::t('isms', 'Manage'). ' ' . Yii::t('isms', 'Organizations'); ?> </h1>
<blockquote> <p> <?php echo Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?> </p> </blockquote>
<?php
$btn = array();
if (Yii::app()->getUser()->checkAccess('Isms.Organization.View')) $btn[] = '{view}';
if (Yii::app()->getUser()->checkAccess('Isms.Organization.Update')) $btn[] = '{update}';
if (Yii::app()->getUser()->checkAccess('Isms.Organization.Delete')) $btn[] = '{delete}';
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'organization-grid',
	'dataProvider' => $model->search() ,
	'filter' => $model,
	'columns' => array(
		'title',
		'description',
		array(
			'class' => 'EButtonColumn',
			'template'	=>	implode(' ', $btn),
		) ,
	) ,
));
echo CHtml::endForm();
