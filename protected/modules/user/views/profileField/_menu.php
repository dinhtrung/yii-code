<ul class="actions">
	<li><?php echo CHtml::link(Yii::t('user', 'Manage User'),array('/user/admin')); ?></li>
	<li><?php echo CHtml::link(Yii::t('user', 'Manage Profile Field'),array('admin')); ?></li>
<?php 
	if (isset($list)) {
		foreach ($list as $item)
			echo "<li>".$item."</li>";
	}
?>
</ul><!-- actions -->