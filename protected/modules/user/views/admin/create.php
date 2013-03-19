<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Users')=>array('admin'),
	Yii::t('user', 'Create'),
);
?>
<h1><?php echo $this->pageTitle = Yii::t('user', "Create User"); ?></h1>

<?php
	echo $this->renderPartial('_menu',array(
		'list'=> array(),
	));
	echo $this->renderPartial('_form', array('model'=>$model));
?>