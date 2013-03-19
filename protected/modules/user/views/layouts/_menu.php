<?php
$this->primary['user'] = array(
	'label' => Yii::t('user', 'User'),
	'items'=>array(
		array('label' => Yii::t('user', 'Admin'), 'url'=>array('/user/admin'), 'visible'=>Yii::app()->user->checkAccess('User.Admin.Index')),
		array('label' => Yii::t('user', 'List'), 'url'=>array('/user'), 'visible'=>Yii::app()->user->checkAccess('User.User.Index')),
		array('label' => Yii::t('user', 'Login'), 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
		array('label' => Yii::t('user', 'Profile'), 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest),
		array('label' => Yii::t('user', 'Logout'), 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest ),
		array('label' => Yii::t('user', 'Register'), 'url'=>array('/user/registration'), 'visible'=>Yii::app()->user->isGuest),
		array('label' => Yii::t('user', 'Recovery'), 'url'=>array('/user/recovery'), 'visible'=>Yii::app()->user->isGuest),
	),
);