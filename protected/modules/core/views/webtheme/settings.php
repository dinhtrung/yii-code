<?php
$this->breadcrumbs=array(
	Yii::t('webtheme', 'Available Webtheme') => array('index'),
	Yii::t('webtheme', 'Configure Webtheme'),
);?>
<?php if(empty($this->menu))
	$this->menu=array(
		array('label'=>Yii::t('webtheme', 'Available Webtheme'),
			'url'=>array('index')),
	);?>
<h1><?php echo $this->pageTitle = Yii::t('webtheme', "Configure Theme Settings"); ?></h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'webTheme-form',
	'enableAjaxValidation'=>FALSE,
	'enableClientValidation'=>TRUE,
	'htmlOptions'	=>	array('enctype' => 'multipart/form-data')
)); ?>

	<p class="note">
	<?php echo Yii::t('webtheme','Fields with <span class="required">*</span> are required');?>.
	</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'siteName'); ?>
		<?php echo $form->textField($model,'siteName'); ?>
		<?php echo $form->error($model,'siteName'); ?>
		<p class="hint"><?php if('_HINT_Webtheme.siteName' != $hint = Yii::t('webtheme', '_HINT_Webtheme.siteName')) echo $hint; ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'siteSlogan'); ?>
		<?php echo $form->textField($model,'siteSlogan'); ?>
		<?php echo $form->error($model,'siteSlogan'); ?>
		<p class="hint"><?php if('_HINT_Webtheme.siteSlogan' != $hint = Yii::t('webtheme', '_HINT_Webtheme.siteSlogan')) echo $hint; ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'siteLogo'); ?>
		<?php echo $form->fileField($model,'siteLogo'); ?>
		<?php echo $form->error($model,'siteLogo'); ?>
		<p class="hint"><?php if('_HINT_Webtheme.siteLogo' != $hint = Yii::t('webtheme', '_HINT_Webtheme.siteLogo')) echo $hint; ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'theme'); ?>
		<?php echo $form->dropDownList($model,'theme', Webtheme::themeOptions()); ?>
		<?php echo $form->error($model,'theme'); ?>
		<p class="hint"><?php if('_HINT_Webtheme.theme' != $hint = Yii::t('webtheme', '_HINT_Webtheme.theme')) echo $hint; ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'serverEmail'); ?>
		<?php echo $form->textField($model,'serverEmail'); ?>
		<?php echo $form->error($model,'serverEmail'); ?>
		<p class="hint"><?php if('_HINT_Webtheme.serverEmail' != $hint = Yii::t('webtheme', '_HINT_Webtheme.serverEmail')) echo $hint; ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contactEmail'); ?>
		<?php echo $form->textField($model,'contactEmail'); ?>
		<?php echo $form->error($model,'contactEmail'); ?>
		<p class="hint"><?php if('_HINT_Webtheme.contactEmail' != $hint = Yii::t('webtheme', '_HINT_Webtheme.contactEmail')) echo $hint; ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'homeUrl'); ?>
		<?php echo $form->textField($model,'homeUrl'); ?>
		<?php echo $form->error($model,'homeUrl'); ?>
		<p class="hint"><?php if('_HINT_Webtheme.homeUrl' != $hint = Yii::t('webtheme', '_HINT_Webtheme.homeUrl')) echo $hint; ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'perPage'); ?>
		<?php echo $form->textField($model,'perPage'); ?>
		<?php echo $form->error($model,'perPage'); ?>
		<p class="hint"><?php if('_HINT_Webtheme.perPage' != $hint = Yii::t('webtheme', '_HINT_Webtheme.perPage')) echo $hint; ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'layout'); ?>
		<?php echo $form->textField($model,'layout'); ?>
		<?php echo $form->error($model,'layout'); ?>
		<p class="hint"><?php if('_HINT_Webtheme.layout' != $hint = Yii::t('webtheme', '_HINT_Webtheme.layout')) echo $hint; ?></p>
		<div class="hint"><?php echo Yii::t('blocktype', "Finds a view file based on its name. The view name can be in one of the following formats:<br>
	<ul>
		<li><strong>absolute view within a module:</strong> the view name starts with a single slash <kbd>'/'</kbd>. In this case, the view will be searched for under the currently active module's view path. If there is no active module, the view will be searched for under the application's view path.</li>
		<li><strong>absolute view within the application:</strong> the view name starts with double slashes <kbd>'//'</kbd>. In this case, the view will be searched for under the application's view path.</li>
		<li><strong>aliased view:</strong> the view name contains dots and refers to a path alias. The view file is determined by calling <code>YiiBase::getPathOfAlias()</code>. Note that aliased views cannot be themed because they can refer to a view file located at arbitrary places.</li>
		<li><strong>relative view:</strong> otherwise. Relative views will be searched for under the currently active controller's view path.</li>
	</ul>
	For absolute view and relative view, the corresponding view file is a PHP file whose name is the same as the view name. The file is located under a specified directory. This method will call CApplication::findLocalizedFile to search for a localized file, if any."); ?></div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('webtheme', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->