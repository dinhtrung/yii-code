<?php
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
	'sourcePath'	=>	dirname(__FILE__).DIRECTORY_SEPARATOR.'../modules/contents',
	'messagePath'	=>	dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'messages/vi',
	'languages'=>array('vi'),
	'fileTypes'=>array('php'),
    'overwrite'=>true,
	
	'exclude'=>array(
		'.svn',
		'.hg',
		'yiilite.php',
		'yiit.php',
		'/i18n/data',
		'/messages',
		'/vendors',
		'/web/js',
		'/extensions',
		'/modules/node',
		'/modules/core',
		'/modules/isms',
		'/modules/shop',
		'/modules/translate',
		'/modules/importcsv',
	),
);
