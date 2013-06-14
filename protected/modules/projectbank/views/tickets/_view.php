
<div class="view row-fluid">
	<h3><?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?></h3>

<?php $this->beginWidget('CMarkdown'); ?><?php echo CHtml::encode($data->body); ?><?php $this->endWidget(); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('createtime')); ?>:</b>
	<?php echo Yii::app()->format->formatDateTime($data->createtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatetime')); ?>:</b>
	<?php echo Yii::app()->format->formatDateTime($data->updatetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
	<?php echo ($data->user)?$data->user->title:NULL; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo $data->project_id?$data->project->title:NULL; ?>
	
	<div class="children offset1">
		<?php $this->widget('bootstrap.widgets.TbListView',array(
			'dataProvider'=>new CActiveDataProvider($data->children()),
			'itemView'=>'_view',
		)); ?>
	</div>
</div>