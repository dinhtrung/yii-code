<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
$classid = $this->class2id($this->modelClass);
$t = strtolower($this->modelClass);
echo "if(!isset(\$this->breadcrumbs))
\$this->breadcrumbs=array(
	Yii::t('$t', '$label')	=>	array(Yii::t('app', 'index')),
	Yii::t('app', 'Settings'),
);\n";
?>

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => '<?php echo $this->modelClass; ?>'));
?>

<h1>
<?php echo "<?php echo \$this->pageTitle = Yii::t('app', 'Settings') . ' ' . Yii::t('$t', '$label  :name', array(':name' => CHtml::encode(\$model))); ?> "; ?>
</h1>


<div class="form">
<p class="note">
<?php echo "<?php echo Yii::t('app','Fields with');?> <span class=\"required\">*</span> <?php echo Yii::t('app','are required');?>";?>.
</p>

<?php
$ajax = ($this->enable_ajax_validation) ? 'true' : 'false';

echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
'id'=>'$classid-form',
	'enableAjaxValidation'=>$ajax,
	)); \n";

echo "\techo \$form->errorSummary(\$model);\n";
echo "?>";
?>

	<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->isPrimaryKey)
		continue;

	if(!$column->isForeignKey
			&& $column->name != 'createtime'
			&& $column->name != 'updatetime'
			&& $column->name != 'timestamp') {
		echo "<div class=\"row\">\n";
		echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n";
		echo "<?php ".$this->generateActiveField($this->modelClass,$column)."; ?>\n";
		echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n";
		$placholder = "_HINT_".$this->modelClass.".".$column->name."";
		echo "<?php if('".$placholder."' != \$hint = Yii::t('$classid', '".$placholder."')) echo \$hint; ?>\n";
		echo "</div>\n\n";
	}
}

?>

<?php echo "<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('app', 'Save'));
\$this->endWidget(); ?>\n";  ?>
</div> <!-- form -->
