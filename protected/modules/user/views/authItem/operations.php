<?php $this->breadcrumbs = array(
	Yii::t('rights', 'Rights')=>Rights::getBaseUrl(),
	Yii::t('rights', 'Operations'),
); ?>

<div id="operations">

	<h1><?php echo $this->pageTitle = Yii::t('rights', 'Operations'); ?></h1>

	<p>
		<?php echo Yii::t('rights', 'An operation is a permission to perform a single operation, for example accessing a certain controller action.'); ?><br />
		<?php echo Yii::t('rights', 'Operations exist below tasks in the authorization hierarchy and can therefore only inherit from other operations.'); ?>
	</p>

	<p><?php echo CHtml::link(Yii::t('rights', 'Create a new operation'), array('authItem/create', 'type'=>CAuthItem::TYPE_OPERATION), array(
		'class'=>'add-operation-link',
	)); ?></p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}',
	    'emptyText'=>Yii::t('rights', 'No operations found.'),
	    'htmlOptions'=>array('class'=>'grid-view operation-table sortable-table'),
	    'columns'=>array(
	    	array(
    			'name'=>'name',
    			'header'=>Yii::t('rights', 'Name'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'name-column'),
    			'value'=>'$data->getGridNameLink()',
    		),
    		array(
    			'name'=>'description',
    			'header'=>Yii::t('rights', 'Description'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'description-column'),
    			'value'=>'Yii::t("rights", $data->getGridNameLink(), array(), "dbmessages")',
    		),
    		array(
    			'name'=>'bizRule',
    			'header'=>Yii::t('rights', 'Business rule'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'bizrule-column'),
    			'visible'=>Rights::module()->enableBizRule===true,
    		),
    		array(
    			'name'=>'data',
    			'header'=>Yii::t('rights', 'Data'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'data-column'),
    			'visible'=>Rights::module()->enableBizRuleData===true,
    		),
    		array(
    			'header'=>'&nbsp;',
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'actions-column'),
    			'value'=>'$data->getDeleteOperationLink()',
    		),
	    )
	)); ?>

	<p class="info"><?php echo Yii::t('rights', 'Values within square brackets tell how many children each item has.'); ?></p>

</div>