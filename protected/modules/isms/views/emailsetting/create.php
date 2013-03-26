<?php
if(empty($this->breadcrumbs))
$this->breadcrumbs=array(
	Yii::t('isms', 'Emailsettings')	=>	'index',
	Yii::t('isms', 'Create'),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('model' => $model));
?>

<h1> <?php echo $this->pageTitle = Yii::t('isms', 'Create').' ' . Yii::t('isms', 'Emailsetting') ; ?> </h1>
<?php
$this->renderPartial('_form', array('model' => $model));

?>

