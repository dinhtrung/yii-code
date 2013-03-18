<?php
echo "<?php\n";
$nameColumn = GHelper::guessNameColumn($this->tableSchema->columns);
$label = $this->pluralize($this->class2name($this->modelClass));
$t = strtolower($this->modelClass);
echo "if(!isset(\$this->breadcrumbs))\n
\$this->breadcrumbs=array(
	Yii::t('$t', '$label')	=>	array('index'),
	\$model->{$nameColumn},
	);\n";
?>

if(empty($this->menu)) $this->renderPartial("_menu", array('model' => $model, 'modelClass' => '<?php echo $this->modelClass; ?>', 'primaryKey' => '<?php echo $this->tableSchema->primaryKey; ?>'));
?>

<h1>
<?php echo "<?php echo \$this->pageTitle = Yii::t('app', 'View') . ' ' . Yii::t('$t', '$label  :name', array(':name' => CHtml::encode(\$model))); ?> "; ?>

</h1>

<div>
<?php echo '<?php $this->beginWidget("CMarkdown");'."\n";
	echo 'echo $model->description;'."\n";
	echo '$this->endWidget(); ?>'."\n\n";
?>
</div>

<?php echo "<?php "; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php foreach ($this->tableSchema->columns as $column) {
		if ($column->isForeignKey) {
			echo "\t\tarray(\n";
			echo "\t\t\t'name'=>'{$column->name}',\n";
			foreach ($this->relations as $key => $relation) {
				if ((($relation[0] == "CHasOneRelation") || ($relation[0] == "CBelongsToRelation")) && $relation[2] == $column->name) {
					$columns = CActiveRecord::model($relation[1])->tableSchema->columns;
					$suggestedfield = $this->suggestName($columns);
					$controller = GHelper::resolveController($relation);
					echo "\t\t\t'value'=>(\$model->{$key} !== null)?CHtml::link(\$model->{$key}->{$suggestedfield->name}, array('{$controller}/view','id'=>\$model->{$key}->id)):'n/a',\n";
					echo "\t\t\t'type'=>'html',\n";
				}
			}
			echo "\t\t),\n";
		} else if (stristr($column->name, 'url')) {
			// TODO - experimental - move to provider class
			echo "array(";
			echo "\t\t\t'name'=>'{$column->name}',\n";
			echo "\t\t\t'type'=>'link',\n";
			echo "),\n";
			} else if($column->name == 'createtime'
					or $column->name == 'updatetime'
					or $column->name == 'timestamp') {
				echo "array(
					'name'=>'{$column->name}',
					'value' =>Yii::app()->getLocale()->getDateFormatter()->formatDateTime(\$model->{$column->name}, 'medium', 'medium')),\n";
			} else
				echo "\t\t'" . $column->name . "',\n";
	}
?>
),
)); ?>

<?php
foreach (CActiveRecord::model(Yii::import($this->model))->relations() as $key => $relation) {
	if ($relation[0] == 'CManyManyRelation' || $relation[0] == 'CHasManyRelation') {
		$model = CActiveRecord::model($relation[1]);
		if (!$pk = $model->tableSchema->primaryKey) $pk = 'id';
		$suggestedtitle = $this->suggestName($model->tableSchema->columns);
		echo "\n\n<h2>";
		echo "<?php echo CHtml::link(Yii::t('$t', '" . ucfirst($key) . "'), array('" . ucfirst($relation[1]) . "/admin'));?>";
		echo "</h2>\n";
		printf("<?php \$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'%s-grid',
					'dataProvider'=> \$model->getDataProvider('%s'),
					//'columns' => array(),
					)); ?>", strtolower($relation[1]), $key);
	}
	if ($relation[0] == 'CHasOneRelation') {
		$model = CActiveRecord::model($relation[1]);
		if (!$pk = $model->tableSchema->primaryKey) $pk = 'id';
		$suggestedtitle = $this->suggestName($model->tableSchema->columns);
		echo "\n\n<h3>";
		echo "<?php echo CHtml::link(Yii::t('$t','{$key}'),'XXX');?>";
		echo "</h3>\n";

		echo CHtml::openTag('ul');
		printf("<?php
					if(\$model->%s !== null) printf('<li>%%s</li>', CHtml::link(\$model->{$key}->%s, array('%s/view', 'id' => \$model->{$key}->%s)));\n
					?>", $key, $suggestedtitle->name, strtolower($relation[1]) , $pk);
		echo CHtml::closeTag('ul');
	}
}
