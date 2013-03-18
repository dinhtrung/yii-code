<?php
/**
 * This is the model base class for the table "node".
 *
 * Columns in table "node" available as properties of the model:
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $body
 * @property integer $createtime
 * @property integer $updatetime
 * @property integer $uid
 * @property integer $cid
 * @property string $tags
 *
 * There are no model relations.
 */
Yii::import('core.models.Node');
class NodeFile extends Node {

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{node}}';
	}

	/**
	 * Override relations
	 */
	public function relations() {
		return array_merge(
			array(
				'files'		=>	array(self::HAS_MANY, 'File', 'pkey',
					'condition' => 'files.entity="'.trim($this->tableName(), '{}').'"',
				),
			),
			parent::relations()
		);
	}
}
