<?php
if (! Yii::app()->getUser()->checkAccess('Isms.Campaign.*')){
	foreach ($model->cporders as $order){
		if ($order->o->userid != UserModule::user()->getId()) throw new CHttpException(404);
	}
	if ($model->approved)
			throw new CHttpException(403, Yii::t('isms', 'This campaign is approved for running, so you cannot edit it anymore.'));
}
if(!isset($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('campaign', 'Campaigns')	=>	array(Yii::t('app', 'index')),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Campaign', 'primaryKey' => 'id'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('app', 'Update') . ' ' . Yii::t('campaign', 'Campaigns :name', array(':name' => CHtml::encode($model))); ?>
</h1>

<?php
$this->renderPartial('_form', array(
			'model'=>$model));
?>
