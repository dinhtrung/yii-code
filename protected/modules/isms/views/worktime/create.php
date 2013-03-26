<?php
if(empty($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('isms', 'Worktimes')=>array(Yii::t('isms', 'index')),
	Yii::t('isms', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Create') . ' ' . Yii::t('isms', 'Worktime'); ?></h1>
<?php
$this->renderPartial('_form', array('model' => $model));

?>

