<?php


$this->breadcrumbs = array(
	Yii::t('cms', "Nodes"),
	Yii::t('cms', 'Index'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Node'));
?>

<h1><?php echo $this->pageTitle = Yii::t('cms', "Search Results for") . ' ' . Yii::t('cms', "Nodes"); ?></h1>

<?php echo CHtml::beginForm(); ?>

<div class="row">
	<?php echo CHtml::label('keyword', Yii::t('cms', 'Keyword')); ?>
	<?php echo CHtml::textField('q', (isset($_POST['q'])?$_POST['q']:''),array('size'=>60,'maxlength'=>255)); ?>
</div>

<?php 
echo CHtml::submitButton(Yii::t('cms', 'Search'));
echo CHtml::endForm(); ?>

<?php if (! is_null($model)) {
		//CVarDumper::dump($model, 20, TRUE); 
		$records = Node::model()->findAllByPk($model->getIdList());
		foreach ($records as $data) $this->renderPartial("_view", array('data' => $data));
		/*$this->widget('CLinkPager', array(
			'pages' => $model->getPaginator()
		));	*/
}
?>