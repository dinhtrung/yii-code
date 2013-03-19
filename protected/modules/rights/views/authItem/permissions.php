<?php $this->breadcrumbs = array(
	Yii::t('rights', 'Rights')=>Rights::getBaseUrl(),
	Yii::t('rights', 'Permissions'),
); ?>

<div id="permissions">

	<h1><?php echo $this->pageTitle = Yii::t('rights', 'Permissions'); ?></h1>

	<p>
		<?php echo Yii::t('rights', 'Here you can view and manage the permissions assigned to each role.'); ?><br />
		<?php echo Yii::t('rights', 'Authorization items can be managed under {roleLink}, {taskLink} and {operationLink}.', array(
			'{roleLink}'=>CHtml::link(Yii::t('rights', 'Roles'), array('authItem/roles')),
			'{taskLink}'=>CHtml::link(Yii::t('rights', 'Tasks'), array('authItem/tasks')),
			'{operationLink}'=>CHtml::link(Yii::t('rights', 'Operations'), array('authItem/operations')),
		)); ?>
	</p>

	<p><?php echo CHtml::link(Yii::t('rights', 'Generate items for controller actions'), array('authItem/generate'), array(
	   	'class'=>'generator-link',
	)); ?></p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$dataProvider,
		'template'=>'{items}',
		'emptyText'=>Yii::t('rights', 'No authorization items found.'),
		'htmlOptions'=>array('class'=>'grid-view permission-table'),
		'columns'=>$columns,
	)); ?>

	<p class="info">*) <?php echo Yii::t('rights', 'Hover to see from where the permission is inherited.'); ?></p>

	<script type="text/javascript">

		/**
		* Attach the tooltip to the inherited items.
		*/
		jQuery('.inherited-item').rightsTooltip({
			title:'<?php echo Yii::t('rights', 'Source'); ?>: '
		});

		/**
		* Hover functionality for rights' tables.
		*/
		$('#rights tbody tr').hover(function() {
			$(this).addClass('hover'); // On mouse over
		}, function() {
			$(this).removeClass('hover'); // On mouse out
		});

	</script>

</div>
