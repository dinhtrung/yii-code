<?php echo "<?php \n";?>

<?php
$elements = array();
foreach ($this->tableSchema->columns as $column) {
	if ($column->isPrimaryKey) continue;
	if (!$column->isForeignKey) {
		$elements[$column->name] = $this->generateCFormField($this->modelClass, $column);
	}
}

?>

return <?php var_export(array('elements' => $elements)); ?>