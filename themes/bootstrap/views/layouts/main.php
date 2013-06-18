<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode(Yii::app()->name); ?> :: <?php echo CHtml::encode(strip_tags($this->pageTitle)); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php
echo TbHtml::codeBlock(var_export($this->mainMenu, TRUE));

 $this->widget('bootstrap.widgets.TbNavbar', array(
    'brandLabel' => Yii::app()->name,
	'display' => NULL,
    'items' =>  array(
		array(
			'class' => 'bootstrap.widgets.TbNav',
			'items' => $this->mainMenu, 
			), 
		)
	)
); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php echo TbHtml::breadcrumbs($this->breadcrumbs); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

</div><!-- page -->

<div id="footer">
	<div class="container">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div>
</div><!-- footer -->
</body>
</html>
