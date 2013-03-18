<?php


$this->breadcrumbs=array(
	Yii::t('node', 'Nodes')	=>	array('index'),
	$model->title	=>	array('view','id'=>$model->id),
	Yii::t('app', 'Delete Confirmation'),
);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Node', 'primaryKey' => 'id'));
?>
<h1>
<?php echo $this->pageTitle = Yii::t('app', 'Continue Delete ') . ' ' . Yii::t('node', 'Nodes :name', array(':name' => CHtml::encode($model))); ?> 
</h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'node-delete',
	'enableAjaxValidation'		=>	FALSE,
	'enableClientValidation' 	=>	FALSE,
)); 
	echo $form->errorSummary($model);
?><p class="note">
	<?php echo Yii::t('app','Are you sure you want to delete this Node :name?', array(':name' => CHtml::encode($model)));?>.
</p>

<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => Yii::app()->getUser()->getReturnUrl()));
echo CHtml::submitButton(Yii::t('app', 'Continue Delete'));
$this->endWidget(); ?>
</div> <!-- form -->
