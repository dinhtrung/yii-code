<?php echo "<?php \n";?>

<?php
$elements = array();
foreach ($this->tableSchema->columns as $column) {
	if ($column->isPrimaryKey) continue;
	if (!$column->isForeignKey) {
		$elements[$column->name] = $this->generateCFormField($this->modelClass, $column);
		$elements[$column->name]['label'] = "Yii::t('".$this->modelClass."', \"".$column->name.'")';
		$elements[$column->name]['hint'] = "Yii::t('".$this->modelClass."', \"_HINT_".$this->modelClass.'.'.$column->name.'")';
	}
}

?>

return <?php var_export(array('elements' => $elements)); ?>;