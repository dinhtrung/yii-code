<h1><?php echo TranslateModule::t('Missing Translations')." - ".TranslateModule::translator()->acceptedLanguages[Yii::app()->getLanguage()]?></h1>
<?php
$source=MessageSource::model()->findAll();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'message-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'message',
        'category',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{create}{delete}',
            'deleteButtonUrl'=>'Yii::app()->getController()->createUrl("missingdelete",array("id"=>$data->id))',
            'buttons'=>array(
                'create'=>array(
                    'label'=>TranslateModule::t('Create'),
                    'url'=>'Yii::app()->getController()->createUrl("create",array("id"=>$data->id,"language"=>Yii::app()->getLanguage()))',
                	'imageUrl'	=> Yii::app()->baseUrl . "/images/icons/add.png",
                )
            ),
            'header'=>TranslateModule::translator()->dropdown(),
        )
	),
)); ?>