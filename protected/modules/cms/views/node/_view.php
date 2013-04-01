<div class="view post">

	<div class="title">
		<h3><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?></h3>
	</div>
	<div class="author small">
		<?php echo Yii::t('cms', "Posted by <strong>%user</strong> on <time>%pubdate</time>", array(
			'%user'		=>	$data->user->username,
			'%pubdate'	=>	Yii::app()->getLocale()->getDateFormatter()->formatDateTime($data->createtime, 'long', NULL),
		)); ?>
	</div>
	<div class="content">
		<?php echo $data->description; ?>
	</div>
	<div class="nav">
		<?php $tags = array();
			foreach ($data->getTags() as $t)
				$tags[] = CHtml::link($t, array("tags", "name" => $t));
		?>
		<strong><?php echo Yii::t('cms', "Tags: %tags", array('%tags' => implode(', ', $tags))); ?></strong>
		<br/>
		<?php echo CHtml::link('Permalink', array('view', 'alias' => $data->alias)); ?> |
		<?php echo Yii::t('cms', "Last updated on %update", array(
				'%update' => Yii::app()->getLocale()->getDateFormatter()->formatDateTime($data->updatetime, 'long', NULL),
			)
		); ?>
	</div>
</div>