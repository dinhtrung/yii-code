<?php
echo "<?php\n";
$nameColumn = GHelper::guessNameColumn($this->tableSchema->columns);
$label = $this->pluralize($this->class2name($this->modelClass));
$t = strtolower($this->modelClass);
echo "if(!isset(\$this->breadcrumbs))
\$this->breadcrumbs=array(
	Yii::t('$t', '$label')	=>	array(Yii::t('app', 'index')),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	Yii::t('app', 'Update'),
);\n";
?>

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => '<?php echo $this->modelClass; ?>', 'primaryKey' => '<?php echo $this->tableSchema->primaryKey; ?>'));
?>

<?php
$pk = "\$model->" . $this->tableSchema->primaryKey;
?>
<h1>
	<?php echo "<?php echo \$this->pageTitle = Yii::t('app', 'Update') . ' ' . Yii::t('$t', '$label :name', array(':name' => CHtml::encode(\$model))); ?> "; ?>

</h1>

<?php echo "<?php\n"; ?>
$this->renderPartial('_form', array(
			'model'=>$model));
?>
