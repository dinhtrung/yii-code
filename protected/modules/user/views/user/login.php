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

<p><?php echo Yii::t('user', "Please fill out the following form with your login credentials:"); ?></p>

<div class="form">
<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo Yii::t('user', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username') ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password') ?>
	</div>

	<div class="row">
		<p class="hint">
		<?php echo CHtml::link(Yii::t('user', "Register"),'/user/registration'); ?> | <?php echo CHtml::link(Yii::t('user', "Lost Password?"),'/user/recovery'); ?>
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton(Yii::t('user', "Login")); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
