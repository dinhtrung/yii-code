<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->pageTitle = Yii::t('dpviews', "Database Viewer"); ?></h1>

<?php
$tabs = array();
foreach ($model->getDbConnection()->getSchema()->tableNames as $dbtable){
	$table = $model->removePrefix($dbtable, FALSE);
	$mdl = DefaultModel::getModel($table);
}
foreach ($model->getDbConnection()->getSchema()->tableNames as $dbtable){
	$table = $model->removePrefix($dbtable, FALSE);

			$this->beginClip($table);
			$mdl = DefaultModel::getModel($table);
			CVarDumper::dump($mdl->relations());
			$columns = $mdl->getTableSchema()->columnNames;
			foreach ($mdl->relations() as $k => $v) $columns[] = "$k:html";
			CVarDumper::dump($columns);
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>$table . '-grid',
				'dataProvider'=>$mdl->search(),
// 				'filter'=>$mdl,
				'columns' =>  $columns,
			));


			$this->endClip();
			$tabs[$table] = array('title' => $table, 'content' => $this->clips[$table]);
}

$this->beginClip('relations');
CVarDumper::dump($model::$relations, 3, TRUE);
$this->endClip();
$tabs['relations'] = array('title' => 'relations', 'content' => $this->clips['relations']);


$this->beginClip('schema');
CVarDumper::dump($model->getDbConnection()->getSchema()->tables, 4, TRUE);
$this->endClip();
$tabs['schema'] = array('title' => 'schema', 'content' => $this->clips['schema']);

?>



<?php
$this->widget("CTabView", array(
		"tabs"	=>	$tabs
));

?>