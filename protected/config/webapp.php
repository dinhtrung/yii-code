<?php
return CMap::mergeArray(require (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'main.php') , array(
	// autoloading model and component classes
	'import' => array(
		// Yii-user
		'application.modules.user.components.*',
		'application.modules.user.models.*',
		// Core
		'application.modules.core.components.*',
		'application.modules.core.models.*',
		// Extension Main Components
		'ext.components.*',
		'ext.helpers.*',
        // Image
		"ext.image.*",
		// Translate
		"application.modules.translate.TranslateModule",
	) ,
	'modules' => array(
		// Translate for Database. Use: Yii::t('source', 'message', array(), 'dbmessage')
		'user',
		'core',
		'translate',
		'cms',
	) ,
	// application components
	'components' => array(
		'request' => array(
			'enableCsrfValidation' => FALSE,
		) ,
		'input' => array(
			'class' => 'ext.components.Input',
			'cleanPost' => true,
			'cleanGet' => true,
		) ,
		// Add XWebDebugRouter for Yii
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CWebLogRoute',
					'levels' => 'error, warning, trace, profile, info',
					'enabled' => YII_DEBUG,
				) ,
			) ,
		) ,
		'user' => array(
			'class' => 'RWebUser',
			'allowAutoLogin' => true,
			'loginUrl' => array(
				'/user/login'
			) ,
		) ,
		'urlManager' => array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		) ,
		'authManager' => array(
			'class' => 'RDbAuthManager',
			'connectionID' => 'db',
			'assignmentTable' => 'authassignment',
			'itemChildTable'	=>	'authitemchild',
			'itemTable'	=>	'authitem',
			'rightsTable'	=>	'rights',
		) ,
		'setting' => array(
			'class' => 'application.components.Settings',
		) ,
		// DB Translator
		'dbtranslate'=>array(
				'class'=>'translate.components.MPTranslate',
				'acceptedLanguages'=>array(
						'en'=>'English',
						'vi'=>'Vietnamese',
				),
		),
		// @TODO: Move me to another preferences
		'widgetFactory'=> array(
				'class' => 'CWidgetFactory',
				'widgets' => array(
						'CGridView'=>array(
							'itemsCssClass'=>'item-class',
							'pagerCssClass'=>'pager-class'
						),
						'CJuiTabs'=>array(
							'htmlOptions'=>array('class'=>'shadowtabs'),
						),
						'CJuiAccordion'=>array(
							'htmlOptions'=>array('class'=>'shadowaccordion'),
						),
						'CJuiProgressBar'=>array(
							'htmlOptions'=>array('class'=>'shadowprogressbar'),
						),
						'CJuiSlider'=>array(
							'htmlOptions'=>array('class'=>'shadowslider'),
						),
						'CJuiSliderInput'=>array(
							'htmlOptions'=>array('class'=>'shadowslider'),
						),
						'CJuiButton'=>array(
							'htmlOptions'=>array('class'=>'shadowbutton'),
						),
						'CJuiButton'=>array(
							'htmlOptions'=>array('class'=>'shadowbutton'),
						),
						'CJuiButton'=>array(
							'htmlOptions'=>array('class'=>'button green'),
						),
				)
		),
	) ,
));
