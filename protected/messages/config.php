<?php
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
	'sourcePath'	=>	dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'messagePath'	=>	dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'messages/vi',
	'languages'=>array('vi'),
	'fileTypes'=>array('php'),
    'overwrite'=>true,
	'removeOld'	=>	TRUE,
	'exclude'=>array(
		'.svn',
		'.hg',
		'.git',
		'yiilite.php',
		'yiit.php',
		'/messages',
		'/vendors',
		'/web/js',
		'/extensions',
	),
);
