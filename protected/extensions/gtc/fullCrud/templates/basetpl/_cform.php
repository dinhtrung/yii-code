<?php echo "<?php \n";?>

<?php
$elements = array();
foreach ($this->tableSchema->columns as $column) {
	if ($column->isPrimaryKey) continue;
	if (!$column->isForeignKey) {
		$elements[$column->name] = $this->generateCFormField($this->modelClass, $column);
		$elements[$column->name]["hint"] = "('_HINT_Webmenu.description' != \$hint = Yii::t('app', '_HINT_Webmenu.description'))?\$hint:''";
	}
}

?>

return <?php var_export(array('elements' => $elements)); ?>