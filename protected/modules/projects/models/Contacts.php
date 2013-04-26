<?php
/**
 * This is the model class for table "contacts".
 *
 * The followings are the available columns in table 'contacts':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $order_by
 * @property string $title
 * @property string $birthday
 * @property string $job
 * @property string $company
 * @property string $department
 * @property string $type
 * @property string $email
 * @property string $email2
 * @property string $url
 * @property string $phone
 * @property string $phone2
 * @property string $fax
 * @property string $mobile
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property string $jabber
 * @property string $icq
 * @property string $msn
 * @property string $yahoo
 * @property string $aol
 * @property string $notes
 * @property integer $project
 * @property string $icon
 * @property string $owner
 * @property integer $private
 */
class Contacts extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Contacts the static model class
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
		return '{{contacts}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
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
		return array_merge(parent::attributeLabels(), array(
		));
	}

	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
			'id' => 'integer',	// 
			'first_name' => 'string',	// 
			'last_name' => 'string',	// 
			'order_by' => 'string',	// 
			'title' => 'string',	// 
			'birthday' => 'string',	// 
			'job' => 'string',	// 
			'company' => 'string',	// 
			'department' => 'string',	// 
			'type' => 'string',	// 
			'email' => 'string',	// 
			'email2' => 'string',	// 
			'url' => 'string',	// 
			'phone' => 'string',	// 
			'phone2' => 'string',	// 
			'fax' => 'string',	// 
			'mobile' => 'string',	// 
			'address1' => 'string',	// 
			'address2' => 'string',	// 
			'city' => 'string',	// 
			'state' => 'string',	// 
			'zip' => 'string',	// 
			'country' => 'string',	// 
			'jabber' => 'string',	// 
			'icq' => 'string',	// 
			'msn' => 'string',	// 
			'yahoo' => 'string',	// 
			'aol' => 'string',	// 
			'notes' => 'string',	// 
			'project' => 'integer',	// 
			'icon' => 'string',	// 
			'owner' => 'string',	// 
			'private' => 'integer',	// 
		);
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->addPrimaryKey('id', $this->tableName(), 'id')
		)->execute();
	}
}