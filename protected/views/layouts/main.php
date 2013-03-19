<!DOCTYPE html >
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?> | <?php echo CHtml::encode(Yii::app()->name); ?> </title>

	</head>
<body>

<div class="container" id="page">

	<div id="header" class="span-24 last">
		<h1 class="span-14 prepend-top"><?php echo CHtml::encode(Yii::app()->name); ?></h1>
		<div class="span-10 last prepend-top">
			<?php if (Yii::app()->getUser()->isGuest):?>
			<p class="flash-warning">Vui lòng <?php echo CHtml::link(
					Yii::t('user', 'Login'),
					Yii::app()->createUrl('user/login')
					); ?> vào hệ thống</p>
			<?php else: ?>
			<p class="flash-success">Xin chào, <?php echo CHtml::link(
					Yii::app()->getUser()->name,
					Yii::app()->createUrl('user/profile')
					); ?> |
					<?php echo CHtml::link(
					Yii::t('user', 'Logout'),
					Yii::app()->createUrl('user/logout')
					); ?>
			</p>
			<?php endif; ?>
		</div>
	</div><!-- header -->
	<hr class="clearfix">
	<div id="mainMbMenu">
		<?php
		$menuitems =  array(
				array('label'=>'Báo cáo', 'url'=>array('/site/index')),
				array('label' => 'Người dùng',
					'items' => array(
						array('label' => 'Đăng nhập', 'url' => array('/user/login'), 'visible' => (Yii::app()->getUser()->isGuest)),
						array('label' => 'Hồ sơ', 'url' => array('/user/profile'), 'visible' => ! (Yii::app()->getUser()->isGuest)),
						array('label' => 'Quản lý người dùng', 'url' => array('/user/admin'), 'visible' => (Yii::app()->getUser()->checkAccess('User.Admin.*'))),
					),
				)
			);
		$this->widget('ext.widgets.mbmenu.MbMenu',array(
			'items'=> $menuitems,
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> VMS Mobifone.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
