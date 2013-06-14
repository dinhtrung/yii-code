<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms', 'Templates')
);
if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Template'));

Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('template-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
?>

<h1><?php echo $this->pageTitle = Yii::t('isms', 'Manage') . ' ' . Yii::t('isms', 'Templates'); ?></h1>
<blockquote> <p> <?php echo Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?> </p> </blockquote>
<?php echo CHtml::link(Yii::t('isms', 'Advanced Search') , '#', array(
	'class' => 'search-button'
)); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div>

<?php
$btn = array();
if (Yii::app()->getUser()->checkAccess('Isms.Template.Update')) $btn[] = '{update}'; 
if (Yii::app()->getUser()->checkAccess('Isms.Template.Delete')) $btn[] = '{delete}'; 
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'template-grid',
	'dataProvider' => $model->search() ,
	'filter' => $model,
	'columns' => array(
		'title',
		'body',
		array(
			'class' => 'EButtonColumn',
			'template'	=>	implode(' ', $btn),
		) ,
	) ,
));
echo CHtml::endForm();
