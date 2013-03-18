<?php


$this->breadcrumbs=array(
	'Nodes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app', 'Delete Confirmation'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Nodes', 'primaryKey' => 'id'));
?>
<h1>
<?php echo $this->pageTitle = Yii::t('app', 'Continue Delete ') . ' ' . Yii::t('Node', 'Nodes :name', array(':name' => CHtml::encode($model))); ?> 
</h1>
<div class="form">
<p class="note">
	<?php echo Yii::t('app','Are you sure you want to delete this Node :name?', array(':name' => CHtml::encode($model));?>.
</p>

<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('app', 'Continue Delete'));
$this->endWidget(); ?>
</div> <!-- form -->
