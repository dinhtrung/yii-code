<?php $this->breadcrumbs = array(
	Yii::t('user', 'Rights') =>Rights::getBaseUrl(),
	Yii::t('user', 'Assignments')=>array('assignment/view'),
	$model->getName(),
); ?>

<div id="userAssignments">

	<h1><?php echo $this->pageTitle = Yii::t('user', 'Assignments for :username', array(':username'=>$model->getName())); ?></h1>
	
	<div class="assignments span-12 first">

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$dataProvider,
			'template'=>'{items}',
			'hideHeader'=>true,
			'emptyText'=>Yii::t('user', 'This user has not been assigned any items.'),
			'htmlOptions'=>array('class'=>'grid-view user-assignment-table mini'),
			'columns'=>array(
    			array(
    				'name'=>'name',
    				'header'=>Yii::t('user', 'Name'),
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'name-column'),
    				'value'=>'$data->getNameText()',
    			),
    			array(
    				'name'=>'type',
    				'header'=>Yii::t('user', 'Type'),
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'type-column'),
    				'value'=>'$data->getTypeText()',
    			),
    			array(
    				'header'=>'&nbsp;',
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'actions-column'),
    				'value'=>'$data->getRevokeAssignmentLink()',
    			),
			)
		)); ?>

	</div>

	<div class="add-assignment span-11 last">

		<h3><?php echo Yii::t('user', 'Assign item'); ?></h3>

		<?php if( $formModel!==null ): ?>

			<div class="form">

				<?php $this->renderPartial('_form', array(
					'model'=>$formModel,
					'itemnameSelectOptions'=>$assignSelectOptions,
				)); ?>

			</div>

		<?php else: ?>

			<p class="info"><?php echo Yii::t('user', 'No assignments available to be assigned to this user.'); ?>

		<?php endif; ?>

	</div>

</div>
