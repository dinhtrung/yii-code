<?php
$path = $model->getDirectory();
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'	=>	$model->getImageDataProvider(),
	'columns'	=>	array(
		'filename',
		'type',
		'size',
		'width',
		'height',
		array(
            'class' => 'ext.yiiext.zii.widgets.grid.imageColumn.EImageColumn',
            // see below.
            'imagePathExpression' => '$data["src"]',
            // Text used when cell is empty.
            // Optional.
            'emptyText' => '—',
            // HTML options for image tag. Optional.
			'imageOptions' => array(
				'alt' => 'no',
				'width'		=>	90,
				'class'	 => 'fancybox'
			),
        ),
	)
));
$url = $this->createUrl('plupload') . '?targetDir='.urlencode($path);

$this->widget('ext.widgets.plupload.PluploadWidget', array(
    'config' => array(
    'runtimes' => 'html5,gears,flash,silverlight,browserplus',
    'url' => $url,
    'max_file_size' => str_replace("M", "mb", ini_get('upload_max_filesize')),
    //'max_file_size' => Yii::app()->params['maxFileSize'],
    'chunk_size' => '1mb',
    'unique_names' => false,
      'filters' => array(
          array('title' => Yii::t('core', 'Images files'), 'extensions' => File::IMAGETYPES),
      ),
    'language' => Yii::app()->language,
    'max_file_number' => 10,
    'autostart' => false,
    'jquery_ui' => false,
    'reset_after_upload' => true,
  ),
  'callbacks' => array(
     'FileUploaded' => 'function(up,file,response){window.location.reload();}',
  ),
  'id' => 'uploader'
));
?>
<br class="clear">
<?php
$images = $model->getImages();
foreach ($images as $k => $v) {
	$images[$k] = array(CHtml::image($v["src"], $v["basename"], array("width" => 140)), $v["basename"], $v["src"], $v["basename"]);
}
$this->widget("ext.widgets.mflip.MFlip", array(
	'data'	=>	$images,
	'width'	=>	160,
	'height'	=>	160,
));
?>