<?php


$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('cms', 'Delete Confirmation'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Comments', 'primaryKey' => 'id'));
?>
<h1>
<?php echo $this->pageTitle = Yii::t('cms', 'Continue Delete ') . ' ' . Yii::t('cms', 'Comments :name', array(':name' => CHtml::encode($model))); ?> 
</h1>
<div class="form">
<p class="note">
	<?php echo Yii::t('cms','Are you sure you want to delete this Comments :name?', array(':name' => CHtml::encode($model));?>.
</p>

<?php
echo CHtml::Button(Yii::t('cms', 'Cancel'), array(
			'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('cms', 'Continue Delete'));
$this->endWidget(); ?>
</div> <!-- form -->
