<?php
/**
 * Render the most recent updated products
 * @var $root : The root node instance
 * @var $items : The children items
 */
if (empty($items)) return;
$this->beginWidget('ext.yiiext.widgets.carousel.ECarouselWidget');
foreach ($items as $data){
	?>
	<li>
		<?php echo CHtml::image($data->Image->getFileUrl(), $data->label, array('title' => $data->label)); ?>
	</li>
<?php
}
$this->endWidget();