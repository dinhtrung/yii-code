<?php
//in your layout add
echo Yii::app()->translate->dropdown();
//adn this
if(Yii::app()->translate->hasMessages()){
	//generates a to the page where you translate the missing translations found in this page
	echo Yii::app()->translate->translateLink('Translate');
	//or a dialog
	echo Yii::app()->translate->translateDialogLink('Translate','Translate page title');
}
//link to the page where you edit the translations
echo Yii::app()->translate->editLink('Edit translations page');
//link to the page where you check for all unstranslated messages of the system
echo Yii::app()->translate->missingLink('Missing translations page');