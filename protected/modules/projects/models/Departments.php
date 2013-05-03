<?php
/**
 * This is the model class for table "departments".
 *
 * The followings are the available columns in table 'departments':
 * @property string $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $title
 * @property string $description
 * @property string $phone
 * @property string $fax
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $url
 * @property integer $createtime
 * @property integer $updatetime
 */
class Departments extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Departments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the CDbConnection component used for this module
	 */
	public function connectionId(){
		return Yii::app()->hasComponent('projectsDb')?'projectsDb':'db';
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{departments}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'projects'	=> array(self::HAS_MANY, 'ProjectDepartment', 'id'),
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array_merge(parent::rules(), array(
			//@FIXME: Add more rules here to override default rules
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array( ));
	}

	/**
	 * Add ENested Set for support child-parent relation
	 */
	public function behaviors()
	{
		return array(
				'nestedSet' => array(
						'class'=>'ext.behaviors.NestedSetBehavior',
						'hasManyRoots'	=>	TRUE,
						'leftAttribute'=>'lft',
						'rightAttribute'=>'rgt',
						'levelAttribute'=>'level',
				),
		);
	}

	/**
	 * Return a list of available option for CHtml::dropDownList() function
	 * @param string $rid
	 * @return multitype:|multitype:string NULL
	 */
	public static function getOptions($rid = NULL){
		$output = array();
		if (is_null($rid)) {
			$models = self::model()->roots()->findAll();
			foreach ($models as $n => $m){
				$output[$m->id] = $m->title;
				$sub = $m->descendants()->findAll();
				foreach ($sub as $c){
					$output[$c->id] = str_repeat('-', $c->level) . $c->title;
				}
			}
		} else {
			$r = self::model()->findByPk($rid);
			if (is_null($r)) return array();
			$output = array();
			$output[$r->id] = $r->title;
			$sub = $r->descendants()->findAll();
			foreach ($sub as $s){
				$output[$s->id] = str_repeat('-', $s->level) . $s->title;
			}
		}
		return $output;
	}

	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
			'id' => 'string',	//
			'root' => 'integer',	//
			'lft' => 'integer',	//
			'rgt' => 'integer',	//
			'level' => 'integer',	//
			'title' => 'string',	//
			'description' => 'string',	//
			'phone' => 'string',	//
			'fax' => 'string',	//
			'address' => 'string',	//
			'city' => 'string',	//
			'state' => 'string',	//
			'zip' => 'string',	//
			'url' => 'string',	//
			'createtime' => 'integer',	//
			'updatetime' => 'integer',	//
		);
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->addPrimaryKey('id', $this->tableName(), 'id')
		)->execute();
	}

	protected function beforeSave(){
		if ($this->isNewRecord){
			$this->createtime = time();
		}
		$this->updatetime = time();
		return parent::beforeSave();
	}
}