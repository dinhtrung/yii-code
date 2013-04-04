<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms', 'Blacklists')
);
if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Blacklist'));

Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('blacklist-grid', {
						data: $(this).serialize()
					});
				return false;
				});
			");
?>

<h1><?php echo $this->pageTitle = Yii::t('isms', 'Manage') . ' ' . Yii::t('isms', 'Blacklists'); ?></h1>
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
if (Yii::app()->getUser()->checkAccess('Isms.Blacklist.View')) $btn[] = '{view}';
if (Yii::app()->getUser()->checkAccess('Isms.Blacklist.Update')) $btn[] = '{update}';
if (Yii::app()->getUser()->checkAccess('Isms.Blacklist.Delete')) $btn[] = '{delete}';
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'blacklist-grid',
	'dataProvider' => $model->search() ,
	'filter' => $model,
	'columns' => array(
		array(
			'name' => 'fid',
			'value' => 'CHtml::value($data,\'f.title\')',
			'filter' => CHtml::listData(Filter::model()->findAll() , 'id', 'title') ,
		) ,
		'isdn',
		array(
			'class'=>'EButtonColumnWithClearFilters',
			'template'	=>	implode(' ', $btn),
		),
	) ,
));
echo CHtml::endForm();
