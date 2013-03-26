<div class="span-8">
	<div class="view">
		<h3><?php echo CHtml::link(CHtml::encode($data) , array('view', 'id' => $data->fid)); ?></h3>
		<?php echo Yii::t('isms', '!title !desc', array(
			'!title' => ($data->title)?'<h4>'.($data->title) . '</h4>':'',
			'!desc' => ($data->description)?'<p class="box">'.($data->description) . '</p>':'',
		));?>
		<?php $this->widget('zii.widgets.CDetailView', array(
				'data' => $data,
				'attributes' => array(
					'filename',
					'filemime',
					'filesize',
					'status',
					'createtime:datetime',
					'updatetime:datetime',
					'uri',
				) ,
			)); ?>
	</div>
</div>
