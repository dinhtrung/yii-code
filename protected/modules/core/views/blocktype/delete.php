<?php


$this->breadcrumbs=array(
	'Blocktypes'=>array('index'),
	$model->title=>array('view','id'=>$model->btid),
	Yii::t('app', 'Delete Confirmation'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Blocktype', 'primaryKey' => 'btid'));
?>
<h1>
<?php echo $this->pageTitle = Yii::t('app', 'Continue Delete') . ' ' . Yii::t('blocktype', 'Blocktypes :name', array(':name' => CHtml::encode($model))); ?>
</h1>
<div class="form">
<p class="note">
	<?php echo Yii::t('blocktype','Are you sure you want to delete this Blocktype :name?', array(':name' => CHtml::encode($model)));?>.
</p>

<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array('submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('app', 'Continue Delete'));
$this->endWidget(); ?>
</div> <!-- form -->
