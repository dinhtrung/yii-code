<?php echo '<?php';
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 */
$modelPath = $this->modelPath;
$moduleId = (explode('.', $this->modelPath));
$moduleId = $moduleId[0];
$relationAttributes = array_keys($relations);
?>

/**
 * This is the model class for table "<?php echo $tableName; ?>".
 *
 * The followings are the available columns in table '<?php echo $tableName; ?>':
<?php foreach($columns as $column): ?>
 * @property <?php echo $column->type.' $'.$column->name."\n"; ?>
<?php endforeach; ?>
 */
class <?php echo $modelClass; ?> extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return <?php echo $modelClass; ?> the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
<?php if ($moduleId != 'application'):?>
	/**
	 * @return string the CDbConnection component used for this module
	 */
	public function connectionId(){
		return Yii::app()->hasComponent('<?php echo $moduleId; ?>Db')?'<?php echo $moduleId; ?>Db':'db';
	}
<?php endif; ?>

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{<?php echo $tableName; ?>}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
<?php foreach($relations as $name=>$relation): ?>
			<?php echo "'$name' => $relation,\n"; ?>
<?php endforeach; ?>
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array_merge(parent::rules(), array(
<?php if (! empty($relations)):?>
			// relations
			array('<?php echo implode(', ', $relationAttributes); ?>', 'safe', 'on' => 'insert,update'),
<?php endif; ?>
			//@FIXME: Add more rules here to override default rules
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
<?php foreach($relationAttributes as $name): ?>
			<?php echo "'$name' => Yii::t('$moduleId', '$name'),\n"; ?>
<?php endforeach; ?>
		));
	}

	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
<?php $pkeys = array(); foreach ($columns as $name => $dbcol):?>
			'<?php echo $name; ?>' => '<?php echo $dbcol->type; ?>',	// <?php echo $dbcol->comment; ?>

<?php if ($dbcol->isPrimaryKey) $pkeys[] = $name; endforeach; ?>
		);
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->addPrimaryKey('<?php echo implode('_', $pkeys); ?>', $this->tableName(), '<?php echo implode(', ', $pkeys); ?>')
		)->execute();
	}
}