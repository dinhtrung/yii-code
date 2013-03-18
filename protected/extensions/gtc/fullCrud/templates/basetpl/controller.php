<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass . "\n"; ?>
{

	public function allowedActions()
	{
		return '';
	}

	public function init(){
		parent::init();
		// TODO: Configure settings for this controller
	}

	/*
	* View detail information for an item
	*/
	public function actionView()
	{
		$this->render('view',array(
			'model' => $this->loadModel(),
		));
	}

	public function actionCreate()
	{
		$model = new <?php echo $this->modelClass; ?>;

		<?php if ($this->enable_ajax_validation) { ?>
$this->performAjaxValidation($model, '<?php echo $this->class2id($this->modelClass) ?>-form');
    <?php
} ?>

		if(!empty($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);

<?php
foreach (CActiveRecord::model($this->modelClass)->relations() as $key => $relation) {
	if ($relation[0] == 'CManyManyRelation') {
		printf("\t\t\tif(!empty(\$_POST['%s']['%s']))\n", $this->modelClass, $relation[1]);
		printf("\t\t\t\t\$model->%s = \$_POST['%s']['%s'];\n", $key, $this->modelClass, $relation[1]);
	}
}
?>

			if($model->save()) {

			$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
				}
			}


		if(Yii::app()->request->isAjaxRequest)
			$this->renderPartial('_miniform',array( 'model'=>$model, 'relation' => $relation));
		else
			$this->render('create',array( 'model'=>$model));
	}


	public function actionUpdate()
	{
		$model = $this->loadModel();

		<?php if ($this->enable_ajax_validation) { ?>
		$this->performAjaxValidation($model, '<?php echo $this->class2id($this->modelClass) ?>-form');
		<?php
} ?>

		if(!empty($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);

<?php
foreach (CActiveRecord::model($this->modelClass)->relations() as $key => $relation) {
	if ($relation[0] == 'CManyManyRelation') {
		printf("\t\t\tif(!empty(\$_POST['%s']['%s']))\n", $this->modelClass, $relation[1]);
		printf("\t\t\t\t\$model->%s = \$_POST['%s']['%s'];\n", $key, $this->modelClass, $relation[1]);
	}
}
?>

	  if($model->save()) {

      $this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
			}
		}

		$this->render('update',array(
					'model'=>$model,
					));
	}

	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel()->delete();

			if(empty($_GET['ajax']))
			{
				if(!empty($_POST['returnUrl']))
					$this->redirect($_POST['returnUrl']);
				else
					$this->redirect(array('admin'));
			}
		}
		else
			throw new CHttpException(400,
					Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('<?php echo $this->modelClass; ?>');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* List available items
	**/
	public function actionAdmin()
	{
		$model=new <?php echo $this->modelClass; ?>('search');
		if (intval(Yii::app()->request->getParam('clearFilters'))==1) {
		    EButtonColumnWithClearFilters::clearFilters($this,$model);
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
