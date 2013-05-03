<?php
/**
 * This is the model class for table "project_contact".
 *
 * The followings are the available columns in table 'project_contact':
 * @property integer $pid
 * @property integer $cid
 */
class ProjectContact extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProjectContact the static model class
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
		return '{{project_contact}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'project'	=>	array(self::BELONGS_TO, 'Projects', 'pid'),
			'contact'	=>	array(self::BELONGS_TO, 'Contacts', 'cid'),
		);
	}

	public function rules() {
		return array_merge(parent::rules(), array(
			array( '*', 'uniqueKeys' ) ,
		));
	}
	public function uniqueKeys() {
		$this->validateCompositeUniqueKeys();
	}
	public function behaviors() {
		return array_merge(parent::behaviors() , array(
				'ECompositeUniqueKeyValidatable' => array(
						'class' => 'ext.behaviors.ECompositeUniqueKeyValidatable',
						'uniqueKeys' => array(
								'attributes' => 'pid, cid',
								'errorMessage' => Yii::t('projects', 'This contact is already assigned to this project') ,
						)
				) ,
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
		));
	}

	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
			'pid' => 'integer',	//
			'cid' => 'integer',	//
		);
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->addPrimaryKey('', $this->tableName(), '')
		)->execute();
	}
}