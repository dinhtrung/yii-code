<?php

class DefaultController extends Controller
{
	function actionIndex(){
		$model = GenericTable::model('authassignment');
		$dataProvider = new CActiveDataProvider($model);
		$this->render('index', array('model' => $model, 'dataProvider' => $dataProvider));
<<<<<<< HEAD
	}

	function actionTest(){
		$tableName = 'users';
		$model = BaseTable::model('users');
		$dataProvider = new CActiveDataProvider($model);
		$relations = $this->getModule()->generateRelations();
		$columns = array_keys($model->getAttributes());
		if (array_key_exists($tableName, $relations)){
			foreach ($relations[$tableName] as $name => $config){
				$columns[] = $name . ":html";
			}
			$model->with($relations[$tableName]);
		}
		CVarDumper::dump($relations, 1, TRUE);
		CVarDumper::dump($columns, 1, TRUE);
		Yii::app()->setComponent('format', new EFormatter());
		$this->render('grid', array('model' => $model, 'columns' => $columns));
	}


	function actionGiime(){
		Yii::import('system.gii.*');
		Yii::import('system.gii.generators.model.*');
		$modelCode = new ModelCode();
		$modelCode->template = 'newModel';
		$modelCode->tableName = 'user';
		$modelCode->baseClass = 'BaseActiveRecords';
		$modelCode->save();
	}


	function actionDynamic(){
		$userModel = DynamicActiveRecord::forTable('users');
		$this->render('grid2', array('model' => $userModel));
		//list existing users
// 		foreach ($userModel->findAll() as $user)
// 			echo $user->id . ': ' . $user->name . '<br>';
		//add new user
// 		$userModel->name = 'Pavle Predic';
// 		$userModel->save();
	}
}

class EFormatter extends CFormatter {
	public function formatHtml($value){
		if (is_array($value)) {
			$output = "<ul>";
			foreach ($value as $k => $v){
				$output .= "<li>".$this->formatText($v) . "</li>";
			}
			return $output . "</ul>";
		}
		else return parent::formatText($value);
	}
	public function formatText($value){
		if (is_array($value)) {
			$output = "";
			foreach ($value as $k => $v){
				$output .= $this->formatText($v) . "\n";
			}
			return $output;
		}
		else return parent::formatText($value);
=======
>>>>>>> querybuilder
	}
}