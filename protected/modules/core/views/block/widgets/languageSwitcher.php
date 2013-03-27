<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'	=>	Yii::t('lang', "Language Switcher"),
		'id'	=>	'language-switcher',
	));
	$items = array();

	foreach (Yii::app()->setting->get('website', 'availableLanguages', Website::availableLanguagesOptions()) as $lang => $label) {
		$items[$lang] = array('label'=> $label, 'url'=>array('/site/language', 'lang' => $lang), 'active' => ($lang == Yii::app()->language));
	}
	$this->widget('zii.widgets.CMenu', array(
		'items'=> $items,
		'htmlOptions'=>array('class'=>'language-switcher'),
	));

$this->endWidget();
?>