<?php
/**
 * Configuration for Dev1
 */
return CMap::mergeArray(require (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'webapp.php') , array(
	'modules' => array(
		'shop'	=>	array(
			'debug'	=>	TRUE,
		),
	) ,
	'components' => array(
	)
));
