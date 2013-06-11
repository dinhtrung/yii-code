<?php
/**
 * Configuration for Dev1
 */
return CMap::mergeArray(require (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'webapp.php') , array(
	'import' => array(
		'ext.gtc.components.*',	// Gii
	) ,
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'myroot',
			'ipFilters' => array(
			) ,
			'generatorPaths' => array(
				'ext.gtc',
				'bootstrap.gii',
			)
		) ,
		'blog',
	) ,
	'components' => array(
	)
));
