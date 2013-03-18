<?php
$label = $this->pluralize($this->class2name($this->modelClass));
$t = strtolower($this->modelClass);
echo "<?php\n";
echo "if(!isset(\$this->breadcrumbs))\n
\$this->breadcrumbs = array(
	Yii::t('$t', '$label'),
);\n";
?>

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => '<?php echo $this->modelClass; ?>'));
?>

<h1><?php echo "<?php echo \$this->pageTitle = Yii::t('app', 'List') . ' ' . Yii::t('$t', '$label'); ?> "; ?></h1>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
