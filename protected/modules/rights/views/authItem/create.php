<?php $this->breadcrumbs = array(
	Yii::t('rights', 'Rights')=>Rights::getBaseUrl(),
	Yii::t('rights', 'Create :type', array(':type'=>Rights::getAuthItemTypeName($_GET['type']))),
); ?>

<div class="createAuthItem">

	<h1><?php echo $this->pageTitle = Yii::t('rights', 'Create :type', array(
		':type'=>Rights::getAuthItemTypeName($_GET['type']),
	)); ?></h1>

	<?php $this->renderPartial('_form', array('model'=>$formModel)); ?>

</div>