<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
	Yii::t('isms', 'Syntaxes') ,
);
if(empty($this->menu)) $this->renderPartial('_menu', array('modelClass' => 'Syntax'));
?>

<h1><?php echo $this->pageTitle = Yii::t('isms', 'Syntaxes'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
)); ?>
