<?php


$this->breadcrumbs=array(
	'Blocktypes'=>array('index'),
	$model->title=>array('view','id'=>$model->btid),
	Yii::t('core', 'Delete Confirmation'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocktype', 'primaryKey' => 'btid'));
?>
<h1>
<?php echo $this->pageTitle = Yii::t('core', 'Continue Delete') . ' ' . Yii::t('core', 'Blocktypes :name', array(':name' => CHtml::encode($model))); ?>
</h1>
<div class="form">
<p class="note">
	<?php echo Yii::t('core','Are you sure you want to delete this Blocktype :name?', array(':name' => CHtml::encode($model)));?>.
</p>

<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array('submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('core', 'Continue Delete'));
$this->endWidget(); ?>
</div> <!-- form -->
