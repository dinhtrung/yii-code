<ul class="actions">
<?php 
	if (count($list)) {
		foreach ($list as $item)
			echo "<li>".$item."</li>";
	}
?>
	<li><?php echo CHtml::link(Yii::t('user', 'List User'),array('/user')); ?></li>
	<li><?php echo CHtml::link(Yii::t('user', 'Manage User'),array('admin')); ?></li>
	<li><?php echo CHtml::link(Yii::t('user', 'Manage Profile Field'),array('profileField/admin')); ?></li>
</ul><!-- actions -->