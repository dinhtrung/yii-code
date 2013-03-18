<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'	=>	Yii::t('lang', "Language Switcher"),
		'id'	=>	'language-switcher',
	));
	$items = array();
	foreach (Yii::app()->lang->getLanguages() as $lang => $name) {
		$items[$lang] = array('label'=> $name, 'url'=>array('', 'lang' => $lang), 'active' => ($lang == Yii::app()->getLanguage()));
	}
	$this->widget('zii.widgets.CMenu', array(
		'items'=> $items,
		'htmlOptions'=>array('class'=>'language-switcher'),
	));

	$this->endWidget();
