<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
	'stateful' => TRUE,
	'enableAjaxValidation'=> FALSE,
)); ?>\n"; ?>

	<?php echo "<?php echo TbHtml::well(Yii::t('app', 'Fields with <span class=\"required\">*</span> are required.')); ?>"; ?>


	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<?php echo "<?php echo ".$this->generateActiveRow($this->modelClass,$column)."; ?>\n"; ?>

<?php
}
?>
	<?php echo "<?php echo TbHtml::formActions(array(
	TbHtml::submitButton(Yii::t('app', 'Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	TbHtml::resetButton(Yii::t('user', 'Reset'), array('color' => TbHtml::BUTTON_COLOR_WARNING)),
)); ?>";
	?>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
