<?php
$this->mainMenu['blog'] = array(
	'label' => Yii::t('blog', 'Blog'),
	'url'=>array('/blog/post/index'),
	'visible' => Yii::app()->user->checkAccess('Blog.Post.Index'),
	'items'=>array(
		array(
			'label' => Yii::t('blog', 'Posts'),
			'url'=>array('/blog/post/index'),
			'visible' => Yii::app()->user->checkAccess('Blog.Post.Index')
		),
		array(
			'label' => Yii::t('blog', 'Manage Posts'),
			'url'=>array('/blog/post/admin'),
			'visible' => Yii::app()->user->checkAccess('Blog.Post.Admin'),
		),
		array(
			'label' => Yii::t('blog', 'Create Posts'),
			'url'=>array('/blog/post/create'),
			'visible' => Yii::app()->user->checkAccess('Blog.Post.Create')
		),
	),
);