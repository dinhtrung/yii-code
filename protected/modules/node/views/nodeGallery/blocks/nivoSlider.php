<?php $this->beginWidget('zii.widgets.CPortlet', array(
	'title'=> $nodeNodeGallery->title,
));
$images = array_slice($nodeNodeGallery->getImages(), 0, $imageCount);

$this->widget('ext.widgets.nivoslider.ENivoSlider', array(
    'images'=> $images,
    )
);
$this->endWidget();
?>
