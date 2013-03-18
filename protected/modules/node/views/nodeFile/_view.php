<div class="view post">

	<div class="title">
		<h3><?php echo CHtml::link(CHtml::encode($data), array('view', 'id'=>$data->id)); ?></h3>
	</div>
	<div class="author small">
		<?php echo Yii::t('NodeModule.node', "Posted by <strong>%user</strong> on <time>%pubdate</time>", array(
			'%user'		=>	$data->user->username,
			'%pubdate'	=>	Yii::app()->getLocale()->getDateFormatter()->formatDateTime($data->createtime, 'long', NULL),,
		)); ?>
	</div>
	<div class="content">
		<?php
			echo $data->description;
		?>
	</div>
	<div class="nav">
		<?php $tags = array();
			foreach ($data->getTags() as $t)
				$tags[] = CHtml::link($t->name, array("tags", "name" => $t->name));
		?>
		<strong><?php echo Yii::t('NodeModule.node', "Tags: %tags", array('%tags' => implode(', ', $tags))); ?></strong>
		<br/>
		<?php echo CHtml::link('Permalink', array('view', 'alias' => $data->alias)); ?> |
		<?php echo Yii::t('NodeModule.node', "Last updated on %update", array('%update' => date('F j, Y',$data->updatetime))); ?>
	</div>
</div>

	<?php /*

	<p class="alt"><?php echo $data->description; ?></p>


	<b><?php echo CHtml::encode($data->getAttributeLabel('createtime')); ?>:</b>
	<?php echo $locale->getLocale()->getDateFormatter()->formatDateTime($data->createtime, 'long', 'medium'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatetime')); ?>:</b>
	<?php echo $locale->getLocale()->getDateFormatter()->formatDateTime($data->updatetime, 'long', 'medium'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alias')); ?>:</b>
	<?php echo CHtml::encode($data->alias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('body')); ?>:</b>
	<?php echo CHtml::encode($data->body); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cid')); ?>:</b>
	<?php echo CHtml::encode($data->cid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tags')); ?>:</b>
	<?php echo CHtml::encode($data->tags); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>
