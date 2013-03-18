<?php
/**
 * Configuration for Dev1
 */
return CMap::mergeArray(require (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'webapp.php') , array(
	'preload'	=>	array('counter', 'translate'),
	'import' => array(
		'ext.yiidebugtb.*',
		'ext.gtc.components.*',
		'application.modules.realtimepbx.models.*',
	) ,
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'myroot',
			'ipFilters' => array(
			) ,
			'generatorPaths' => array(
				'ext.gtc',
			)
		) ,
		'node',
		'contents',
	) ,
	'components' => array(
		'db' => array(
			'connectionString' => 'mysql:host=localhost;unix_socket=/var/lib/mysql/mysql.sock;port=3306;dbname=yii_corecms',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'myroot',
			'charset' => 'utf8',
			'tablePrefix' => '',
			'enableParamLogging' => TRUE,
			'enableProfiling' => TRUE
		) ,
		'counter' => array(
            'class' => 'ext.components.UserCounter',
		),
		// Remove me in production mode.
		'cache' => array(
			'class' => 'system.caching.CDummyCache',
		) ,
		// Remove me in production mode.
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'ext.yiidebugtb.XWebDebugRouter',
					'config' => 'alignRight, yamlStyle',
					'levels' => 'error, warning, trace, profile, info',
				) ,
			) ,
		) ,
		'sphinx' => array(
            'class' => 'application.components.DGSphinxSearch',
            'server' => '127.0.0.1',
            'port' => 9312,
            'maxQueryTime' => 3000,
            'enableProfiling'=>1,
            'enableResultTrace'=>1,
            'fieldWeights' => array(
                'title' => 10000,
                'description' => 1000,
                'body' => 100,
            ),
        ),
	) ,
));
