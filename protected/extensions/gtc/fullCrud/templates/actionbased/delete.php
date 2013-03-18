<?php
echo "<?php\n";
$nameColumn = GHelper::guessNameColumn($this->tableSchema->columns);
$label = $this->pluralize($this->class2name($this->modelClass));
$t = strtolower($this->modelClass);
$pk = "\$model->" . $this->tableSchema->primaryKey;
echo "if(!isset(\$this->breadcrumbs))\n
\$this->breadcrumbs=array(
	Yii::t('$t', '$label')	=>	array('index'),
	\$model->{$nameColumn}	=>	array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	Yii::t('app', 'Delete Confirmation'),
);\n";
?>

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => '<?php echo $this->modelClass; ?>', 'primaryKey' => '<?php echo $this->tableSchema->primaryKey; ?>'));
?>
<h1>
<?php echo "<?php echo \$this->pageTitle = Yii::t('app', 'Continue Delete ') . ' ' . Yii::t('$t', '$label :name', array(':name' => CHtml::encode(\$model))); ?> "; ?>

</h1>
<div class="form">
<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-delete',
	'enableAjaxValidation'		=>	FALSE,
	'enableClientValidation' 	=>	FALSE,
)); \n";

echo "\techo \$form->errorSummary(\$model);\n";
echo "?>";
?>
<p class="note">
	<?php echo "<?php echo Yii::t('app','Are you sure you want to delete this {$this->modelClass} :name?', array(':name' => CHtml::encode(\$model)));?>";?>.
</p>

<?php echo "<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('app', 'Continue Delete'));
\$this->endWidget(); ?>\n";  ?>
</div> <!-- form -->
