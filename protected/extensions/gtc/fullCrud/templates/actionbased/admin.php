<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
$t = strtolower($this->modelClass);
echo "if(!isset(\$this->breadcrumbs))\n
\$this->breadcrumbs=array(
	Yii::t('$t', '$label')  =>	array('index'),
	Yii::t('app', 'Manage'),
);\n";
?>

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => '<?php echo $this->modelClass; ?>'));

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
					data: $(this).serialize()
				});
				return false;
				});
			");
		?>

<h1>
<?php echo "<?php echo \$this->pageTitle = Yii::t('app', 'Manage') . ' ' . Yii::t('$t', '$label'); ?> "; ?>

</h1>

<?php echo "<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>"; ?>

<div class="search-form" style="display:none">
<?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n"; ?>
</div>

<?php echo "<?php
\$locale = CLocale::getInstance(Yii::app()->language);\n
"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t".$this->generateValueField($this->modelClass, $column).",\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
