<?php
$this->breadcrumbs=array(
	Yii::t('ShopModule.shop', 'Categories')=>array('index'),
	$model->title=>array('view','id'=>$model->getPrimaryKey()),
	Yii::t('ShopModule.shop', 'Update'),
);

?>

<h1><?php echo Yii::t('ShopModule.shop', 'Update Category'); ?> <?php echo $model->getPrimaryKey(); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
