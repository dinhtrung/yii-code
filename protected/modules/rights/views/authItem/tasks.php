<?php $this->breadcrumbs = array(
	Yii::t('rights', 'Rights') =>Rights::getBaseUrl(),
	Yii::t('rights', 'Tasks'),
); ?>

<div id="tasks">

	<h1><?php echo $this->pageTitle = Yii::t('rights', 'Tasks'); ?></h1>

	<p>
		<?php echo Yii::t('rights', 'A task is a permission to perform multiple operations, for example accessing a group of controller action.'); ?><br />
		<?php echo Yii::t('rights', 'Tasks exist below roles in the authorization hierarchy and can therefore only inherit from other tasks and/or operations.'); ?>
	</p>

	<p><?php echo CHtml::link(Yii::t('rights', 'Create a new task'), array('authItem/create', 'type'=>CAuthItem::TYPE_TASK), array(
		'class'=>'add-task-link',
	)); ?></p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}',
	    'emptyText'=>Yii::t('rights', 'No tasks found.'),
	    'htmlOptions'=>array('class'=>'grid-view task-table'),
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
    			'value'=>'$data->getNameLink()',
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
    			'value'=>'$data->getDeleteTaskLink()',
    		),
	    )
	)); ?>

	<p class="info"><?php echo Yii::t('rights', 'Values within square brackets tell how many children each item has.'); ?></p>

</div>