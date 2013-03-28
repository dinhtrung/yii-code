<?php

class User extends BaseActiveRecord
{
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_BANED=-1;

	public $role;

	/**
	 * The followings are the available columns in table 'users':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $activkey
	 * @var integer $createtime
	 * @var integer $lastvisit
	 * @var string $role
	 * @var integer $status
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	public function connectionId(){
		return 'db';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		$columns = $this->getTableSchema()->getColumnNames();

		if (Yii::app()->user->id==$this->id) $rules = array(
			array('username, email', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => Yii::t('user', "Incorrect username (length between 3 and 20 characters).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => Yii::t('user', "This user's name already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => Yii::t('user', "Incorrect symbols (A-z0-9).")),
			array('email', 'unique', 'message' => Yii::t('user', "This user's email address already exists.")),
		);
		else $rules = array(
			array('username, email', 'required'),
			array('password', 'required', 'on' => 'insert'),
			array('password, role', 'safe'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => Yii::t('user', "Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => Yii::t('user', "Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => Yii::t('user', "This user's name already exists.")),
			array('email', 'unique', 'message' => Yii::t('user', "This user's email address already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => Yii::t('user', "Incorrect symbols (A-z0-9).")),
			array('status', 'in', 'range'=>array(self::STATUS_NOACTIVE,self::STATUS_ACTIVE,self::STATUS_BANED)),
			array('username, email, createtime, lastvisit, role, status', 'required'),
			array('createtime, lastvisit, status', 'numerical', 'integerOnly'=>true),
		);
		return array_merge($rules, array(
			array(implode(',', $columns), 'safe'),
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'site'	=>	array(self::BELONGS_TO, 'Organization', 'org'),
		);
	}

	public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'status='.self::STATUS_ACTIVE,
            ),
            'notactvie'=>array(
                'condition'=>'status='.self::STATUS_NOACTIVE,
            ),
            'banned'=>array(
                'condition'=>'status='.self::STATUS_BANED,
            ),
            'role'=>array(
                'condition'=>'role=1',
            ),
            'notsafe'=>array(
            	'select' => 'id, username, password, email, activkey, createtime, lastvisit, role, status',
            ),
        );
    }

	public function defaultScope()
    {
        return array(
        );
    }

	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'UserStatus' => array(
				self::STATUS_NOACTIVE => Yii::t('user', 'Not active'),
				self::STATUS_ACTIVE => Yii::t('user', 'Active'),
				self::STATUS_BANED => Yii::t('user', 'Banned'),
			),
			'AdminStatus' => array(
				'0' => Yii::t('user', 'No'),
				'1' => Yii::t('user', 'Yes'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}


	protected function afterFind(){
		if (Yii::app()->hasModule('rights')){
			$assignedItems = Rights::getAuthorizer()->getAuthItems(CAuthItem::TYPE_ROLE, $this->getPrimaryKey());
			$this->role = array_keys($assignedItems);
		}
		return parent::afterFind();
	}
}