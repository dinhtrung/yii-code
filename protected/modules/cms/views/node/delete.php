<?php


$this->breadcrumbs=array(
	Yii::t('cms', 'Nodes')	=>	array('index'),
	$model->title	=>	array('view','id'=>$model->id),
	Yii::t('cms', 'Delete Confirmation'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Node', 'primaryKey' => 'id'));
?>
<h1>
<?php echo $this->pageTitle = Yii::t('cms', 'Continue Delete ') . ' ' . Yii::t('cms', 'Nodes :name', array(':name' => CHtml::encode($model->title))); ?> 
</h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'node-delete',
	'enableAjaxValidation'		=>	FALSE,
	'enableClientValidation' 	=>	FALSE,
)); 
	echo $form->errorSummary($model);
?><p class="note">
	<?php echo Yii::t('cms','Are you sure you want to delete this Node :name?', array(':name' => CHtml::encode($model->title)));?>.
</p>

<?php
echo CHtml::Button(Yii::t('cms', 'Cancel'), array(
			'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('cms', 'Continue Delete'));
$this->endWidget(); ?>
</div> <!-- form -->
