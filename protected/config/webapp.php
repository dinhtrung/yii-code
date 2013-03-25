<?php
return CMap::mergeArray(require (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'main.php') , array(
	// autoloading model and component classes
	'import' => array(
		// Rights
		'application.modules.rights.components.*',
		'application.modules.rights.models.*',
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
	) ,
	'modules' => array(
		// Translate for Database. Use: Yii::t('source', 'message', array(), 'dbmessage')
		'core',
		'user',
		'rights' => array(
			'superuserName' => 'Admin', // Name of the role with super user privileges.
			'authenticatedName' => 'Authenticated', // Name of the authenticated user role.
			'userClass' => 'User', // Name of the User model class.
			'userIdColumn' => 'id', // Name of the user id column in the database.
			'userNameColumn' => 'username', // Name of the user name column in the database.
			'enableBizRule' => true, // Whether to enable authorization item business rules.
			'enableBizRuleData' => false, // Whether to enable data for business rules.
			'flashSuccessKey' => 'RightsSuccess', // Key to use for setting success flash messages.
			'flashErrorKey' => 'RightsError', // Key to use for setting error flash messages.
			'baseUrl' => '/rights', // Base URL for Rights. Change if module is nested.
			'cssFile' => 'rights.css', // Style sheet file to use for Rights.
		) ,
		'translate',
		'querybuilder',
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
					'class' => 'ext.yiidebugtb.XWebDebugRouter',
					'config' => 'alignRight, yamlStyle',
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
			'class' => 'ext.components.Settings',
		) ,
		'file' => array(
			'class' => 'ext.components.CFile',
		) ,
		// DB Translator
		'dbtranslate'=>array(
				'class'=>'translate.components.MPTranslate',
				'acceptedLanguages'=>array(
						'en'=>'English',
						'vi'=>'Vietnamese',
				),
		),
	) ,
));
