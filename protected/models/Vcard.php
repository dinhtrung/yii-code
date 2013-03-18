<?php

/**
 * This is the model base class for the table "vcard".
 *
 * Columns in table "vcard" available as properties of the model:
 * @property integer $id
 * @property integer $status
 * @property string $first_name
 * @property string $last_name
 * @property string $display_name
 * @property string $nickname
 * @property string $screen_name
 * @property string $email1
 * @property string $email2
 * @property string $office_tel
 * @property string $home_tel
 * @property string $fax_tel
 * @property string $pager_tel
 * @property string $cell_tel
 * @property string $home_address
 * @property string $home_extended_address
 * @property string $home_po_box
 * @property string $home_city
 * @property string $home_state
 * @property string $home_postal_code
 * @property string $home_country
 * @property string $home_website
 * @property string $birthday
 * @property string $title
 * @property string $department
 * @property string $company
 * @property string $work_address
 * @property string $work_extended_address
 * @property string $work_po_box
 * @property string $work_city
 * @property string $work_state
 * @property string $work_postal_code
 * @property string $work_country
 * @property string $work_website
 * @property string $photo
 * @property string $biography
 *
 * There are no model relations.
 */
class Vcard extends BaseActiveRecord{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	* Initializes this model.
	*/
	public function init()
	{
		return parent::init();
	}
	/**
	* This magic method is used for setting a string value for the object. It will be used if the object is used as a string.
	* @return string representing the object
	*/
	public function __toString() {
		return (string) $this->first_name;

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return 'vcard';
	}
	/**
	* Define validation rules
	*/
	public function rules()
	{
		return array(
			array('photo', 'file', 'allowEmpty'=>TRUE, 'types' => File::IMAGETYPES),
			array('status, first_name, last_name, display_name, nickname, screen_name, email1, email2, office_tel, home_tel, fax_tel, pager_tel, cell_tel, home_address, home_extended_address, home_po_box, home_city, home_state, home_postal_code, home_country, home_website, birthday, title, department, company, work_address, work_extended_address, work_po_box, work_city, work_state, work_postal_code, work_country, work_website, biography', 'default', 'setOnEmpty' => true, 'value' => null),
			array('status', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, office_tel, home_tel, fax_tel, pager_tel, cell_tel, home_city, home_state, title, work_city, work_state, work_country', 'length', 'max'=>20),
			array('display_name, nickname, screen_name, email1, email2, home_country, department', 'length', 'max'=>40),
			array('home_address, home_extended_address, home_po_box, company, work_address, work_extended_address, work_po_box', 'length', 'max'=>80),
			array('home_postal_code, birthday, work_postal_code', 'length', 'max'=>10),
			array('home_website, work_website', 'length', 'max'=>255),
			array('biography', 'safe'),
			array('id, status, first_name, last_name, display_name, nickname, screen_name, email1, email2, office_tel, home_tel, fax_tel, pager_tel, cell_tel, home_address, home_extended_address, home_po_box, home_city, home_state, home_postal_code, home_country, home_website, birthday, title, department, company, work_address, work_extended_address, work_po_box, work_city, work_state, work_postal_code, work_country, work_website, biography', 'safe', 'on'=>'search'),
		);
	}
	/**
	* Relation to other models
	*/
	public function relations()
	{
		return array(
		);
	}
	/**
	* Attribute labels
	*/
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('vcard', 'ID'),
			'status' => Yii::t('vcard', 'Status'),
			'first_name' => Yii::t('vcard', 'First Name'),
			'last_name' => Yii::t('vcard', 'Last Name'),
			'display_name' => Yii::t('vcard', 'Display Name'),
			'nickname' => Yii::t('vcard', 'Nickname'),
			'screen_name' => Yii::t('vcard', 'Screen Name'),
			'email1' => Yii::t('vcard', 'Email1'),
			'email2' => Yii::t('vcard', 'Email2'),
			'office_tel' => Yii::t('vcard', 'Office Tel'),
			'home_tel' => Yii::t('vcard', 'Home Tel'),
			'fax_tel' => Yii::t('vcard', 'Fax Tel'),
			'pager_tel' => Yii::t('vcard', 'Pager Tel'),
			'cell_tel' => Yii::t('vcard', 'Cell Tel'),
			'home_address' => Yii::t('vcard', 'Home Address'),
			'home_extended_address' => Yii::t('vcard', 'Home Extended Address'),
			'home_po_box' => Yii::t('vcard', 'Home Po Box'),
			'home_city' => Yii::t('vcard', 'Home City'),
			'home_state' => Yii::t('vcard', 'Home State'),
			'home_postal_code' => Yii::t('vcard', 'Home Postal Code'),
			'home_country' => Yii::t('vcard', 'Home Country'),
			'home_website' => Yii::t('vcard', 'Home Website'),
			'birthday' => Yii::t('vcard', 'Birthday'),
			'title' => Yii::t('vcard', 'Title'),
			'department' => Yii::t('vcard', 'Department'),
			'company' => Yii::t('vcard', 'Company'),
			'work_address' => Yii::t('vcard', 'Work Address'),
			'work_extended_address' => Yii::t('vcard', 'Work Extended Address'),
			'work_po_box' => Yii::t('vcard', 'Work Po Box'),
			'work_city' => Yii::t('vcard', 'Work City'),
			'work_state' => Yii::t('vcard', 'Work State'),
			'work_postal_code' => Yii::t('vcard', 'Work Postal Code'),
			'work_country' => Yii::t('vcard', 'Work Country'),
			'work_website' => Yii::t('vcard', 'Work Website'),
			'photo' => Yii::t('vcard', 'Photo'),
			'biography' => Yii::t('vcard', 'Biography'),
		);
	}
	/**
	* Which attribute are safe for search
	*/
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('status', $this->status);
		$criteria->compare('first_name', $this->first_name, true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('display_name', $this->display_name, true);
		$criteria->compare('nickname', $this->nickname, true);
		$criteria->compare('screen_name', $this->screen_name, true);
		$criteria->compare('email1', $this->email1, true);
		$criteria->compare('email2', $this->email2, true);
		$criteria->compare('office_tel', $this->office_tel, true);
		$criteria->compare('home_tel', $this->home_tel, true);
		$criteria->compare('fax_tel', $this->fax_tel, true);
		$criteria->compare('pager_tel', $this->pager_tel, true);
		$criteria->compare('cell_tel', $this->cell_tel, true);
		$criteria->compare('home_address', $this->home_address, true);
		$criteria->compare('home_extended_address', $this->home_extended_address, true);
		$criteria->compare('home_po_box', $this->home_po_box, true);
		$criteria->compare('home_city', $this->home_city, true);
		$criteria->compare('home_state', $this->home_state, true);
		$criteria->compare('home_postal_code', $this->home_postal_code, true);
		$criteria->compare('home_country', $this->home_country, true);
		$criteria->compare('home_website', $this->home_website, true);
		$criteria->compare('birthday', $this->birthday, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('department', $this->department, true);
		$criteria->compare('company', $this->company, true);
		$criteria->compare('work_address', $this->work_address, true);
		$criteria->compare('work_extended_address', $this->work_extended_address, true);
		$criteria->compare('work_po_box', $this->work_po_box, true);
		$criteria->compare('work_city', $this->work_city, true);
		$criteria->compare('work_state', $this->work_state, true);
		$criteria->compare('work_postal_code', $this->work_postal_code, true);
		$criteria->compare('work_country', $this->work_country, true);
		$criteria->compare('work_website', $this->work_website, true);
		$criteria->compare('photo', $this->photo, true);
		$criteria->compare('biography', $this->biography, true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'first_name ASC',
		);
	}
	/**
	* Run before validate()
	*/
	protected function beforeValidate() {
		return parent::beforeValidate();
	}
	/**
	* Run after validate()
	*/
	protected function afterValidate() {
		return parent::afterValidate();
	}
	/**
	* Run before save()
	*/
	protected function beforeSave() {
		if ($this->photo instanceof CUploadedFile){
			$this->photo->saveAs(DirectoryHelper::safe_directory(Yii::getPathOfAlias("webroot") . DIRECTORY_SEPARATOR . Yii::app()->setting->get("file", "path", "files")) . DIRECTORY_SEPARATOR . $this->photo->getName());
		}
		return parent::beforeSave();
	}
	/**
	* Run after save()
	*/
	protected function afterSave() {
		return parent::afterSave();
	}
	/**
	* Run before delete()
	*/
	protected function beforeDelete() {
		return parent::beforeDelete();
	}
	/**
	* Run after delete()
	*/
	protected function afterDelete() {
		return parent::afterDelete();
	}
	/**
	* Configure additional behaviors
	*
	public function behaviors()
	{
		return array_merge(
			array(
				'BehaviourName' => array(
					'class' => 'CWhateverBehavior'
				)
			),
			parent::behaviors()
		);
	}
	*/
}
