<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('isms', 'Emailsettings')	=>	array('index'),
	$model->hostname,
	Yii::t('isms', 'Update'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('model' => $model));
?>

<h1> <?php echo $this->pageTitle = Yii::t('isms', 'Update'). ' ' . Yii::t('isms', 'Emailsetting') . ' ' . CHtml::encode($model); ?> </h1>
<?php
$this->renderPartial('_form', array('model'=>$model));
?>
