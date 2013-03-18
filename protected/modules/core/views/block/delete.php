<?php


$this->breadcrumbs=array(
	'Blocks'=>array('index'),
	$model->title=>array('view','id'=>$model->bid),
	Yii::t('block', 'Delete Confirmation'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocks', 'primaryKey' => 'bid'));
?>
<h1>
<?php echo $this->pageTitle = Yii::t('block', 'Continue Delete') . ' ' . Yii::t('Block', 'Blocks :name', array(':name' => CHtml::encode($model))); ?>
</h1>
<div class="form">
<p class="note">
	<?php echo Yii::t('block','Are you sure you want to delete this Block :name?', array(':name' => CHtml::encode($model)));?>.
</p>

<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('block', 'Continue Delete'));
$this->endWidget(); ?>
</div> <!-- form -->
