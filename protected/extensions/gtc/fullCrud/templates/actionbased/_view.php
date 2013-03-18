<div class="view">

<h3><?php echo "\t<?php echo CHtml::link(CHtml::encode(\$data), array('view', 'id'=>\$data->{$this->tableSchema->primaryKey})); ?>\n"; ?></h3>

<div>
<?php echo '<?php $this->beginWidget("CMarkdown");'."\n";
	echo 'echo $data->description;'."\n";
	echo '$this->endWidget(); ?>'."\n\n";
?>
</div>

<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if($column->isPrimaryKey)
		continue;
	if(++$count==7)
		echo "\t<?php /*\n";
	echo "\t<b><?php echo CHtml::encode(\$data->getAttributeLabel('{$column->name}')); ?>:</b>\n";
		if($column->name == 'createtime'
				or $column->name == 'updatetime'
				or $column->name == 'timestamp') {
	echo "\t<?php echo Yii::app()->getLocale()->getDateFormatter()->formatDateTime(\$data->{$column->name}, 'long', 'medium'); ?>\n\t<br />\n\n";
} else {
	echo "\t<?php echo CHtml::encode(\$data->{$column->name}); ?>\n\t<br />\n\n";
}
}
if($count>=7)
	echo "\t*/ ?>\n";
?>

</div>
