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

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainMbMenu">
		<?php
		$menuitems =  array(
				array('label'=>'Báo cáo', 'url'=>'/site/index'),
				array('label' => 'Người dùng',
					'items' => array(
						array('label' => 'Đăng nhập', 'url' => 'user/login', 'visible' => (Yii::app()->getUser()->isGuest)),
						array('label' => 'Hồ sơ', 'url' => 'user/profile', 'visible' => ! (Yii::app()->getUser()->isGuest)),
						array('label' => 'Quản lý người dùng', 'url' => '/user/admin', 'visible' => (Yii::app()->getUser()->checkAccess('User.Admin.*'))),
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