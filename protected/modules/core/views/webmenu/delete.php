<?php


$this->breadcrumbs=array(
	'Web Menus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app', 'Delete Confirmation'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Web Menus', 'primaryKey' => 'id'));
?>
<h1>
<?php echo $this->pageTitle = Yii::t('app', 'Continue Delete') . ' ' . Yii::t('Webmenu', 'Web Menus :name', array(':name' => CHtml::encode($model))); ?>
</h1>
<div class="form">
<p class="note">
	<?php echo Yii::t('webmenu','Are you sure you want to delete this Webmenu :name?', array(':name' => CHtml::encode($model)));?>.
</p>

<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array('submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('app', 'Continue Delete'));
$this->endWidget(); ?>
</div> <!-- form -->
