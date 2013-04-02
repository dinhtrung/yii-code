<?php
$file = $path . DIRECTORY_SEPARATOR . $name;
if (file_exists($file)){

	$src = Yii::app()->getRequest()->hostInfo  . Yii::app()->getAssetManager()->publish($file);
	print $src;
	$this->widget('ext.widgets.mediaplayer.StrobeMediaPlayback',
		array(
	    	'src'		=>	$src,
			'src_title'	=>	$title,
	        'playlistLinks'	=>	array(),
			'width'		=>'320',
			'height'	=>'240',
			'allowFullScreen'	=>	'true'    //default is true

	));
}
?>