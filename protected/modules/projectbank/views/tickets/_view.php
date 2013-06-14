
<div class="view row-fluid">
	<h3 class="span-9"><?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?></h3>
	<header class="span-3">
		<i class="icon-user"></i><?php echo $data->user->title; ?>
		<i class="icon-time"></i><time pubdate="<?php echo date('Y-m-d', $data->createtime); ?>" datetime="<?php echo date('Y-m-d', $data->updatetime); ?>">
			<?php echo Yii::app()->format->formatDate($data->updatetime); ?>
		</time>        	
    </header>
    <div class="span-12">
	    <?php $this->beginWidget('CMarkdown'); ?><?php echo CHtml::encode($data->body); ?><?php $this->endWidget(); ?>
    </div>
	
	<section class="offset1">
		<?php $this->widget('bootstrap.widgets.TbListView',array(
			'dataProvider'=>new CActiveDataProvider($data->children()),
			'itemView'=>'_view',
		)); ?>
	</section>
</div>