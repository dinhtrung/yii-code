<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
$t = strtolower($this->modelClass);
echo "if(!isset(\$this->breadcrumbs))
\$this->breadcrumbs=array(
	Yii::t('$t', '$label')	=>	array('index'),
	Yii::t('app', 'Create'),
);\n";
?>

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => '<?php echo $this->modelClass; ?>'));
?>

<h1>
	<?php echo "<?php echo \$this->pageTitle = Yii::t('app', 'Create') . ' ' . Yii::t('$t', '$label'); ?> "; ?>

</h1>

<?php echo "<?php\n"; ?>
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

