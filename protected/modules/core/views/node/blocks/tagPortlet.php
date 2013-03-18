<?php
/** Display the Taggable Widget **/
$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=> Yii::t('node', "Tags for Node"),
));
$this->widget("ext.yiiext.behaviors.model.taggable.ETagListWidget", array(
	"model" => new Node,
	"field"	=>	"Taggable",
	"all"	=>	TRUE,
	"count"	=> 	FALSE,
	"url"	=>	"/core/node"
));
$this->endWidget();