<?php
$this->breadcrumbs=array(
	Yii::t('user', "Profile"),
);
?><h1><?php echo $this->pageTitle = Yii::t('user', 'Your profile'); ?></h1>
<?php echo $this->renderPartial('menu'); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes' => array(
			'username',
			'email',
			'createtime:datetime',
			'updatetime:datetime',
			'role',
		)
	));
