<?php echo "<?php
\$locale = CLocale::getInstance(Yii::app()->language);\n
"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
	if (++$count == 4) echo "\t\t/*\n";
	echo "\t\t" . $this->generateValueField($this->modelClass, $column) . ",\n";
}
if ($count >= 4) echo "\t\t*/\n";
?>
	),
));
