<?php
$file = $path . DIRECTORY_SEPARATOR . $name;
if (file_exists($file))
	echo CHtml::image(Yii::app()->getAssetManager()->publish($file), $title, array('title' => CHtml::encode($description)));
else
	echo Yii::t('core', "Missing image file: %file", array('%file' => $name));