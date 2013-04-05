<?php
/**
 * Configuration for Dev1
 */
return CMap::mergeArray(require (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'webapp.php') , array(
	'import' => array(
		'ext.gtc.components.*',	// Gii
		'application.modules.translate.TranslateModule', // Translate
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
		'dotproject',
		'dpviews',
	) ,
	'components' => array(
			'dotprojectDb'=>array(
					'class' => 'CDbConnection',
					'connectionString' => 'mysql:host=localhost;dbname=yii_dev_dotproject',
					'emulatePrepare' => true,
					'username' => 'root',
					'password' => 'myroot',
					'charset' => 'utf8',
					'tablePrefix' => '',
					'enableParamLogging' => TRUE,
					'enableProfiling' => TRUE
			),
			'dpviewsDb'=>array(
					'class' => 'CDbConnection',
					'connectionString' => 'mysql:host=localhost;dbname=yii_blog',
					'emulatePrepare' => true,
					'username' => 'root',
					'password' => 'myroot',
					'charset' => 'utf8',
					'tablePrefix' => 'tbl_',
					'enableParamLogging' => TRUE,
					'enableProfiling' => TRUE
			),
		'translate'=>array(//if you name your component something else change TranslateModule
				'class'=>'translate.components.MPTranslate',
				//any avaliable options here
				'acceptedLanguages'=>array(
						'en'=>'English',
						'vi'=>'Vietnamese',
				),
				'autoTranslate'	=> FALSE,
		),
	)
));
