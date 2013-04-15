<?php


$this->breadcrumbs=array(
	'Web Menus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('core', 'Delete Confirmation'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Web Menus', 'primaryKey' => 'id'));
?>
<h1>
<?php echo $this->pageTitle = Yii::t('core', 'Continue Delete') . ' ' . Yii::t('core', 'Web Menus :name', array(':name' => CHtml::encode($model->label))); ?>
</h1>
<div class="form">
<p class="note">
	<?php echo Yii::t('core','Are you sure you want to delete this Webmenu :name?', array(':name' => CHtml::encode($model->label)));?>.
</p>

<?php
echo CHtml::Button(Yii::t('core', 'Cancel'), array('submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('core', 'Continue Delete'));
$this->endWidget(); ?>
</div> <!-- form -->
