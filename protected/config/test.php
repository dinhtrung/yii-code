<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'import'=>array(
		   'ext.CrudUnit.*'
		),
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			/* uncomment the following to provide test database connection
			'db'=>array(
				'connectionString'=>'DSN for test database',
			),
			*/
		),
	)
);
