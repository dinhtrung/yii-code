<?php


$this->breadcrumbs=array(
	'Blocks'=>array('index'),
	$model->title=>array('view','id'=>$model->bid),
	Yii::t('core', 'Delete Confirmation'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocks', 'primaryKey' => 'bid'));
?>
<h1>
<?php echo $this->pageTitle = Yii::t('core', 'Continue Delete') . ' ' . Yii::t('core', 'Blocks :name', array(':name' => CHtml::encode($model->title))); ?>
</h1>
<div class="form">
<p class="note">
	<?php echo Yii::t('core','Are you sure you want to delete this Block :name?', array(':name' => CHtml::encode($model->title)));?>.
</p>

<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array(
			'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('core', 'Continue Delete'));
$this->endWidget(); ?>
</div> <!-- form -->
