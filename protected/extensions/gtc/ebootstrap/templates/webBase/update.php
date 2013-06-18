<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
if (is_array($this->tableSchema->primaryKey)){
	$viewUrl = 'array("view", $model->primaryKey)';
} else 
	$viewUrl = 'array("view", "id" => $model->primaryKey)';
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->title=> {$viewUrl},
	'Update',
);\n";
?>
?>

<h1><?php echo "<?php echo \$this->pageTitle = Yii::t('app', 'Update <small>{$this->pluralize($this->class2name($this->modelClass))}</small> :title', array(':title' => \$model->title)); ?>"; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form{$this->modelClass}',array('model'=>\$model)); ?>"; ?>
