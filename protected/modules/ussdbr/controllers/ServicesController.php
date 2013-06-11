<?php
class ServicesController extends Controller {

	public function actionIndex(){
		$availableFormat = array('text', 'html', 'xml', 'vxml', 'namevalue', 'list');
		if (! isset($_GET['format'])) $format = 'text'; 
		elseif (! in_array($_GET['format'], $availableFormat)) $format = 'text';
		else $format = $_GET['format'];
		if (! isset($_GET['view'])){
			echo "ERROR: Please give me the \$_GET['page'] parameter";
			echo CHtml::link("Like This", array("index", "format" => $format, "view" => "about"));
		} else {
			Yii::import("ext.helpers.Transliteration");
			echo Transliteration::text($this->renderPartial($format . "/" . $_GET['view'], NULL, TRUE));
		}
		Yii::app()->end();
	}
}
