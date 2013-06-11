<?php $tables = Yii::app()->db->schema->tableNames; ?>
<ul>
	<?php foreach ($tables as $table): ?>
	<li><?php echo CHtml::link($table, array('table', 'table' => $table)); ?></li>
	<?php endforeach; ?>
</ul>