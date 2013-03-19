<?php $this->breadcrumbs = array(
	Yii::t('rights', 'Rights')=>Rights::getBaseUrl(),
	Rights::getAuthItemTypeNamePlural($model->type)=>Rights::getAuthItemRoute($model->type),
	$model->name,
); ?>

<div id="updatedAuthItem">

	<h1><?php echo Yii::t('rights', 'Update :name', array(
		':name'=>$model->name,
		':type'=>Rights::getAuthItemTypeName($model->type),
	)); ?></h1>

	<?php $this->renderPartial('_form', array('model'=>$formModel)); ?>

	<div class="relations span-11 last">

		<h3><?php echo Yii::t('rights', 'Relations'); ?></h3>

		<?php if( $model->name!==Rights::module()->superuserName ): ?>

			<div class="parents">

				<h4><?php echo Yii::t('rights', 'Parents'); ?></h4>

				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$parentDataProvider,
					'template'=>'{items}',
					'hideHeader'=>true,
					'emptyText'=>Yii::t('rights', 'This item has no parents.'),
					'htmlOptions'=>array('class'=>'grid-view parent-table mini'),
					'columns'=>array(
    					array(
    						'name'=>'name',
    						'header'=>Yii::t('rights', 'Name'),
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'name-column'),
    						'value'=>'$data->getNameLink()',
    					),
    					array(
    						'name'=>'type',
    						'header'=>Yii::t('rights', 'Type'),
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'type-column'),
    						'value'=>'$data->getTypeText()',
    					),
    					array(
    						'header'=>'&nbsp;',
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'actions-column'),
    						'value'=>'',
    					),
					)
				)); ?>

			</div>

			<div class="children">

				<h4><?php echo Yii::t('rights', 'Children'); ?></h4>

				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$childDataProvider,
					'template'=>'{items}',
					'hideHeader'=>true,
					'emptyText'=>Yii::t('rights', 'This item has no children.'),
					'htmlOptions'=>array('class'=>'grid-view parent-table mini'),
					'columns'=>array(
    					array(
    						'name'=>'name',
    						'header'=>Yii::t('rights', 'Name'),
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'name-column'),
    						'value'=>'$data->getNameLink()',
    					),
    					array(
    						'name'=>'type',
    						'header'=>Yii::t('rights', 'Type'),
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'type-column'),
    						'value'=>'$data->getTypeText()',
    					),
    					array(
    						'header'=>'&nbsp;',
    						'type'=>'raw',
    						'htmlOptions'=>array('class'=>'actions-column'),
    						'value'=>'$data->getRemoveChildLink()',
    					),
					)
				)); ?>

			</div>

			<div class="addChild">

				<h5><?php echo Yii::t('rights', 'Add Child'); ?></h5>

				<?php if( $childFormModel!==null ): ?>

					<?php $this->renderPartial('_childForm', array(
						'model'=>$childFormModel,
						'itemnameSelectOptions'=>$childSelectOptions,
					)); ?>

				<?php else: ?>

					<p class="info"><?php echo Yii::t('rights', 'No children available to be added to this item.'); ?>

				<?php endif; ?>

			</div>

		<?php else: ?>

			<p class="info">
				<?php echo Yii::t('rights', 'No relations need to be set for the superuser role.'); ?><br />
				<?php echo Yii::t('rights', 'Super users are always granted access implicitly.'); ?>
			</p>

		<?php endif; ?>

	</div>

</div>