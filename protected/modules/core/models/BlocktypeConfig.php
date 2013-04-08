<?php
Yii::import('ext.components.ArrayModel');
class BlocktypeConfig extends ArrayModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function rules(){
		return array(
				array(implode(', ', array_values($this->arrayStructure())), 'safe'),
		);
	}

	public function arrayStructure(){
		return array(
			'btid'	=>	'btid',
			'title'	=>	'title',
			'description'	=>	'description',
			'component'	=>	'component',
			'callback'	=>	'callback',
			'viewfile'	=>	'viewfile',
		);
	}
}
