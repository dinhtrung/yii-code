<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->pageTitle = Yii::t('querybuilder', "Browse database table :table", array(':table' => $model->tableName())); ?></h1>


<div class="form wide">
	<?php foreach ($model->getAttributes() as $k => $v):?>
		<div class="row">
			<label><?php echo $model->getAttributeLabel($k); ?></label>
				<?php echo CHtml::activeTextField($model, $k); ?>
		</div>
	<?php endforeach; ?>
</div>

<?php $this->renderPartial('grid', array('model' => $model)); ?>

<?php
//@FIXME: There is no way to render related BELONGS_TO relationship...
	$relations = $model->relations();
	foreach ($model->getTableSchema()->foreignKeys as $foreignKey => $relData){
		$relType = ($foreignKey == $model->getTableSchema()->primaryKey)?CActiveRecord::HAS_MANY:CActiveRecord::BELONGS_TO;
		$refTable = $relData[0];
		$refField = $relData[1];
		$relatedModel = GenericTable::model($refTable);
		$relatedModel->setScenario('search');
		$relatedModel->setAttribute($refField, $model->getPrimaryKey());
		echo $refField . ' = ' . $model->getPrimaryKey();
		if ($relType == CActiveRecord::HAS_MANY){
			echo Yii::t('querybuilder', "Has Many :related", array(':related' => Yii::t('querybuilder', $refTable)));
			$this->renderPartial('grid', array('model' => $relatedModel));
		} elseif ($relType == CActiveRecord::BELONGS_TO){
			echo Yii::t('querybuilder', "Belongs to :related", array(':related' => Yii::t('querybuilder', $refTable)));
			$this->renderPartial('detail', array('model' => $relatedModel));
		}
	}
?>
