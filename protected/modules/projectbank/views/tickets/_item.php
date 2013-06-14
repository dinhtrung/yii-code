<article id="tickets-<?php echo $data->id; ?>" class="row-fluid">
	<header class="span-12">
		<h3><?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?></h3>
		<i class="icon-user"></i><?php echo $data->user->title; ?>
		<i class="icon-time"></i><time pubdate="<?php echo date('Y-m-d', $data->createtime); ?>" datetime="<?php echo date('Y-m-d', $data->updatetime); ?>">
			<?php echo Yii::app()->format->formatDate($data->updatetime); ?>
		</time>        	
    </header>
    
    <?php $this->beginWidget('CMarkdown'); ?><?php echo CHtml::encode($data->body); ?><?php $this->endWidget(); ?>
	
	<footer>
	</footer>    
</article>