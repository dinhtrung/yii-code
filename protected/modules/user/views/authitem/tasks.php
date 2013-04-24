<?php $this->breadcrumbs = array(
	Yii::t('user', 'Rights') =>Rights::getBaseUrl(),
	Yii::t('user', 'Tasks'),
); ?>
<div id="tasks">

	<h1><?php echo $this->pageTitle = Yii::t('user', 'Tasks'); ?></h1>

	<p>
		<?php echo Yii::t('user', 'A task is a permission to perform multiple operations, for example accessing a group of controller action.'); ?><br />
		<?php echo Yii::t('user', 'Tasks exist below roles in the authorization hierarchy and can therefore only inherit from other tasks and/or operations.'); ?>
	</p>

	<p><?php echo CHtml::link(Yii::t('user', 'Create a new task'), array('authItem/create', 'type'=>CAuthItem::TYPE_TASK), array(
		'class'=>'add-task-link',
	)); ?></p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}',
	    'emptyText'=>Yii::t('user', 'No tasks found.'),
	    'htmlOptions'=>array('class'=>'grid-view task-table'),
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
    			'value'=>'$data->getNameLink()',
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
    			'value'=>'$data->getDeleteTaskLink()',
    		),
	    )
	)); ?>

	<p class="info"><?php echo Yii::t('user', 'Values within square brackets tell how many children each item has.'); ?></p>

</div>