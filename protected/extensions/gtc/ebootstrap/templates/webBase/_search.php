<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl(\$this->route),
	'layout' => TbHtml::FORM_LAYOUT_SEARCH,
	'method'=>'get',
)); ?>\n"; ?>

<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field=$this->generateInputField($this->modelClass,$column);
	if(strpos($field,'password')!==false)
		continue;
?>
	<?php echo "<?php echo ".$this->generateActiveRow($this->modelClass,$column)."; ?>\n"; ?>

<?php endforeach; ?>
	<?php echo "<?php echo TbHtml::formActions(array(
	TbHtml::submitButton(Yii::t('app', 'Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	TbHtml::resetButton(Yii::t('user', 'Reset'), array('color' => TbHtml::BUTTON_COLOR_WARNING)),
)); ?>";
	?>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
