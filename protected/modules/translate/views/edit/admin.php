<h1><?php echo TranslateModule::t('Manage Messages')?></h1>

<?php
$source=MessageSource::model()->findAll();
$btns = array();
if (Yii::app()->user->checkAccess('Translate.Edit.Update')) $btns[] = '{update}';
if (Yii::app()->user->checkAccess('Translate.Edit.Delete')) $btns[] = '{delete}';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'message-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'category',
		'message',
		'language',
        'translation',
        array(
            'class'=>'CButtonColumn',
            'template'=>implode(' ', $btns),
            'updateButtonUrl'=>'Yii::app()->getController()->createUrl("update",array("id"=>$data->id,"language"=>$data->language))',
            'deleteButtonUrl'=>'Yii::app()->getController()->createUrl("delete",array("id"=>$data->id,"language"=>$data->language))',
        )
	),
)); ?>
