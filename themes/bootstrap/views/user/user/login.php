<?php $this->breadcrumbs=array(
	Yii::t('user', "Login"),
);
?>

<h1><?php echo $this->pageTitle= Yii::t('user', "Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
'stateful' => TRUE,
)); ?>

<?php echo TbHtml::errorSummary($model); ?>
<fieldset>
	<legend><?php echo Yii::t('user', "Please fill out the following form with your login credentials:"); ?></legend>
	
	<?php echo TbHtml::activeTextFieldControlGroup($model, 'username'); ?>

	<?php echo TbHtml::activePasswordFieldControlGroup($model, 'password'); ?>
	
	<?php echo TbHtml::activeCheckBoxControlGroup($model, 'rememberMe'); ?>
 
</fieldset>
	
	
<?php echo TbHtml::formActions(array(
	TbHtml::submitButton(Yii::t('user', 'Login'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	TbHtml::link(Yii::t('user', "Register"), array('registration'), array('class' => 'btn btn-success')),
	TbHtml::link(Yii::t('user', "Lost Password?"), array('recovery'), array('class' => 'btn btn-warning')),
)); ?>
 
<?php $this->endWidget(); ?>