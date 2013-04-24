<?php $this->breadcrumbs = array(
	Yii::t('rights', 'Rights')=>Rights::getBaseUrl(),
	Yii::t('rights', 'Generate items'),
); ?>

<div id="generator">

	<h1><?php echo $this->pageTitle = Yii::t('rights', 'Generate items'); ?></h1>

	<p><?php echo Yii::t('rights', 'Please select which items you wish to generate.'); ?></p>

	<div class="form">

		<?php $form=$this->beginWidget('CActiveForm'); ?>

			<div class="row">

				<table class="items generate-item-table">

					<tbody>

						<tr class="application-heading-row">
							<th colspan="3"><?php echo Yii::t('rights', 'Application'); ?></th>
						</tr>

						<?php $this->renderPartial('_generateItems', array(
							'model'=>$model,
							'form'=>$form,
							'items'=>$items,
							'existingItems'=>$existingItems,
							'displayModuleHeadingRow'=>true,
							'basePathLength'=>strlen(Yii::app()->basePath),
						)); ?>

					</tbody>

				</table>

			</div>

			<div class="row">

   				<?php echo CHtml::link(Yii::t('rights', 'Select all'), '#', array(
   					'onclick'=>"jQuery('.generate-item-table').find(':checkbox').attr('checked', 'checked'); return false;",
   					'class'=>'selectAllLink')); ?>
   				/
				<?php echo CHtml::link(Yii::t('rights', 'Select none'), '#', array(
					'onclick'=>"jQuery('.generate-item-table').find(':checkbox').removeAttr('checked'); return false;",
					'class'=>'selectNoneLink')); ?>

			</div>

   			<div class="row">

				<?php echo CHtml::submitButton(Yii::t('rights', 'Generate')); ?>

			</div>

		<?php $this->endWidget(); ?>

	</div>

</div>