<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('isms', 'Ftpsettings')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('isms', 'Update'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Ftpsetting', 'primaryKey' => 'id'));
?>

<h1> <?php echo $this->pageTitle = Yii::t('app', 'Update') . ' ' . Yii::t('isms', 'Ftpsettings') . ' ' .  $model;?>  </h1>
<?php
$this->renderPartial('_form', array('model'=>$model));
?>
