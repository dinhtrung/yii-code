<?php $this->breadcrumbs = array(
	Yii::t('user', 'User')=>array('/user/admin'),
	Yii::t('user', 'Create :type', array(':type'=>Rights::getAuthItemTypeName($_GET['type']))),
); ?>
	<?php $this->renderPartial('_menu', array('model'=>$formModel)); ?>

<div class="createAuthItem">

	<h1><?php echo $this->pageTitle = Yii::t('user', 'Create :type', array(
		':type'=>Rights::getAuthItemTypeName($_GET['type']),
	)); ?></h1>

	<?php $this->renderPartial('_form', array('model'=>$formModel)); ?>

</div>