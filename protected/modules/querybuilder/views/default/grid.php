<?php
$columns = array();
foreach ($model->getTableSchema()->columns as $columnName => $columnData){
	if ($columnData->type == 'string')
		$columns[] = "$columnName:ntext";
	elseif ($columnData->type == 'int')
		$columns[] = "$columnName:number";
}
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'			=>	GenericTable::$tableName . '-grid',
			'dataProvider'	=>	$model->search(),
			'filter'	=>	$model,
			'columns'	=>	$columns,
));