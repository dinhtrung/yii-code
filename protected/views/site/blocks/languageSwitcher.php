<?php $items = array();
	foreach (Yii::app()->lang->getLanguages() as $lang => $name) {
		$name = Yii::t('lang', $lang);
		$icon = CHtml::image(Yii::app()->getBaseUrl() . "/images/flags/" . $lang . ".png");
		$items[$lang] = array('label'=> $icon . CHtml::encode($name), 'url'=>array('', 'lang' => $lang), 'active' => ($lang == Yii::app()->getLanguage()));
	}
	$this->widget('zii.widgets.CMenu', array(
		'id'	=> 'language-switcher',
		'encodeLabel' => FALSE,
		'items'	=> $items,
		'htmlOptions'=>array('class'=>'language-switcher'),
	));