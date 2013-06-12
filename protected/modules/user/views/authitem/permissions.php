<?php $this->breadcrumbs = array(
	Yii::t('user','User')	=>	array('/user/admin'),
	Yii::t('user','Authitem')	=>	array('/user/authitem'),
	Yii::t('user', 'Permissions'),
); ?>

<div id="permissions">

	<h1><?php echo $this->pageTitle = Yii::t('user', 'Permissions'); ?></h1>

	<p>
		<?php echo Yii::t('user', 'Here you can view and manage the permissions assigned to each role.'); ?><br />
	</p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$dataProvider,
		'template'=>'{items}',
		'emptyText'=>Yii::t('user', 'No authorization items found.'),
		'htmlOptions'=>array('class'=>'grid-view permission-table'),
		'columns'=>$columns,
	)); ?>

	<p class="info">*) <?php echo Yii::t('user', 'Hover to see from where the permission is inherited.'); ?></p>

	<script type="text/javascript">

		/**
		* Attach the tooltip to the inherited items.
		*/
		jQuery('.inherited-item').rightsTooltip({
			title:'<?php echo Yii::t('user', 'Source'); ?>: '
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
