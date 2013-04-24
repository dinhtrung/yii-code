<?php $this->breadcrumbs = array(
	Yii::t('user', 'Rights')=>Rights::getBaseUrl(),
	Yii::t('user', 'Operations'),
); ?>

<div id="operations">

	<h1><?php echo $this->pageTitle = Yii::t('user', 'Operations'); ?></h1>

	<p>
		<?php echo Yii::t('user', 'An operation is a permission to perform a single operation, for example accessing a certain controller action.'); ?><br />
		<?php echo Yii::t('user', 'Operations exist below tasks in the authorization hierarchy and can therefore only inherit from other operations.'); ?>
	</p>

	<p><?php echo CHtml::link(Yii::t('user', 'Create a new operation'), array('authItem/create', 'type'=>CAuthItem::TYPE_OPERATION), array(
		'class'=>'add-operation-link',
	)); ?></p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}',
	    'emptyText'=>Yii::t('user', 'No operations found.'),
	    'htmlOptions'=>array('class'=>'grid-view operation-table sortable-table'),
	    'columns'=>array(
	    	array(
    			'name'=>'name',
    			'header'=>Yii::t('user', 'Name'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'name-column'),
    			'value'=>'$data->getGridNameLink()',
    		),
    		array(
    			'name'=>'description',
    			'header'=>Yii::t('user', 'Description'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'description-column'),
    			'value'=>'Yii::t("rights", $data->getGridNameLink(), array(), "dbmessages")',
    		),
    		array(
    			'name'=>'bizRule',
    			'header'=>Yii::t('user', 'Business rule'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'bizrule-column'),
    		),
    		array(
    			'name'=>'data',
    			'header'=>Yii::t('user', 'Data'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'data-column'),
    		),
    		array(
    			'header'=>'&nbsp;',
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'actions-column'),
    			'value'=>'$data->getDeleteOperationLink()',
    		),
	    )
	)); ?>

	<p class="info"><?php echo Yii::t('user', 'Values within square brackets tell how many children each item has.'); ?></p>

</div>