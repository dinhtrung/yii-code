<div class="view">
	<h3>
		<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
	</h3>

	<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->description;
			$this->endWidget();
	?>
</div>
