<?php


$this->breadcrumbs=array(
	Yii::t('cms', "Nodes") =>array('index'),
	$model->title,
	);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Node', 'primaryKey' => 'id'));

Yii::app()->clientScript->registerMetaTag($model->description, 'description');
Yii::app()->clientScript->registerMetaTag($model->Taggable->toString(), 'keywords');

?>

<div class="view post">

	<div class="title">
		<h2><?php echo $this->pageTitle = CHtml::encode($model->title); ?></h2>
	</div>
	<div class="author small">
		<?php echo Yii::t('cms', "Posted by <strong>%user</strong> on <time>%pubdate</time>", array(
			'%user'		=>	$model->user->username,
			'%pubdate'	=>	Yii::app()->getLocale()->getDateFormatter()->formatDateTime($model->createtime, 'long', 'short'),
		)); ?>
	</div>

	<div class="content">
		<?php
			echo $model->body;
		?>
	</div>
	<div class="nav">
		<?php $tags = array();
			foreach ($model->getTags() as $t)
				$tags[] = CHtml::link($t, array("tags", "name" => $t));
		?>
			<strong><?php echo Yii::t('cms', "Tags: %tags", array('%tags' => implode(', ', $tags))); ?></strong>
			<br/>
		<?php if (! is_null($model->category)): ?>
			<strong><?php echo Yii::t('cms', "Category: %category", array('%category' => CHtml::link($model->category->title, array('category', 'id' => $model->category->id)))); ?></strong>
			<br/>
		<?php endif; ?>
		<?php echo CHtml::link('Permalink', array('view', 'alias' => $model->alias)); ?> |
		<?php echo CHtml::link("Export PDF", array("view", "id" => $model->id, "view" => "pdf")); ?> |
		<?php echo Yii::t('cms', "Last updated on %update", array('%update' => date('F j, Y',$model->updatetime))); ?>
	</div>
</div>

<?php /*
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'alias',
		'description',
		'body',
array(
					'name'=>'createtime',
					'value' =>Yii::app()->getLocale()->getDateFormatter()->formatDateTime($model->createtime, 'medium', 'medium')),
array(
					'name'=>'updatetime',
					'value' =>Yii::app()->getLocale()->getDateFormatter()->formatDateTime($model->updatetime, 'medium', 'medium')),
		'uid',
		'cid',
		'tags',
		'type',
		'status',
),
)); */

