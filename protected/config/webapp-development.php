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
			)
		) ,
		'opencode',
	) ,
	'components' => array(
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
