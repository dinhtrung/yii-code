<?php
$file = $path . DIRECTORY_SEPARATOR . $name;
$this->widget('ext.widgets.audioplayer.AiiAudioPlayer' ,
        array (
            'playerID' => TextHelper::utf2ascii($name, TRUE, '-'),
            'singlePlayer' 	=> true,
        	'mp3Folder'		=>	$path,
            'trackOptions'	=> array(
            	'soundFile' 	=> 	$name ,
        		'titles' 		=> $title,
                'artists' 		=> $description,
            	'alternative' 	=> 	Yii::t('cms', "Missing audio file: %file", array('%file' => $name)) ),
            'flashPlayerOptions' => array( 'width' => 350 ),
    ) );
