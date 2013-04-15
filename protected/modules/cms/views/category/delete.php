<?php


$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('cms', 'Delete Confirmation'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Categories', 'primaryKey' => 'id'));
?>
<h1>
<?php echo $this->pageTitle = Yii::t('cms', 'Continue Delete') . ' ' . Yii::t('cms', 'Categories :name', array(':name' => CHtml::encode($model->title))); ?>
</h1>
<div class="form">
<p class="note">
	<?php echo Yii::t('cms','Are you sure you want to delete this Category :name?', array(':name' => CHtml::encode($model->title)));?>.
</p>

<?php
echo CHtml::Button(Yii::t('cms', 'Cancel'), array('submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('cms', 'Continue Delete'));
$this->endWidget(); ?>
</div> <!-- form -->
