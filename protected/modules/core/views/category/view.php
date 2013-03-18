<?php
if(empty($this->breadcrumbs))

$this->breadcrumbs=array(
	Yii::t('category', 'Categories') =>array('index'),
	$model->title,
	);

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => 'Categories', 'primaryKey' => 'id'));
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('app', 'View') . ' ' . Yii::t('category', 'Category :name', array(':name' => CHtml::encode($model))); ?>
</h1>

<div>
<?php
	$this->beginWidget("CMarkdown");
	echo $model->description;
	$this->endWidget();
?>
</div>
<?php // TODO: List all relation here ?>
<h3><?php echo Yii::t('category', 'Children category of :category', array(':category' => $model->title));?></h3>

<?php
$descendants = $model->children()->findAll();
foreach ($descendants as $data){
	$this->renderPartial("_view", array("data" => $data));
}
?>