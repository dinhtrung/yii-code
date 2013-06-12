<?php $this->breadcrumbs = array(
	Yii::t('user','User')	=>	array('/user/admin'),
	Yii::t('user','Authitem')	=>	array('/user/authitem'),
	Yii::t('user', 'Roles'),
); ?>

<div id="roles">

	<h1><?php echo $this->pageTitle =  Yii::t('user', 'Roles'); ?></h1>

	<p>
		<?php echo Yii::t('user', 'A role is group of permissions to perform a variety of tasks and operations, for example the authenticated user.'); ?><br />
		<?php echo Yii::t('user', 'Roles exist at the top of the authorization hierarchy and can therefore inherit from other roles, tasks and/or operations.'); ?>
	</p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}',
	    'emptyText'=>Yii::t('user', 'No roles found.'),
	    'htmlOptions'=>array('class'=>'grid-view role-table'),
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
    			'value'=>'$data->getNameText()',
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
    			'value'=>'$data->getDeleteRoleLink()',
    		),
	    )
	)); ?>

	<p class="info"><?php echo Yii::t('user', 'Values within square brackets tell how many children each item has.'); ?></p>

</div>