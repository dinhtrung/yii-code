<?php
/**
 * This is the template for generating the model class of a specified table.
 * In addition to the default model Code, this adds the CSaveRelationsBehavior
 * to the model class definition.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 */
?>
<?php echo "<?php\n"; ?>

/**
 * This is the model base class for the table "<?php echo $tableName; ?>".
 *
 * Columns in table "<?php echo $tableName; ?>" available as properties of the model:
<?php foreach($columns as $column): ?>
 * @property <?php echo $column->type.' $'.$column->name."\n"; ?>
<?php endforeach; ?>
 *
<?php if(count($relations)>0): ?>
 * Relations of table "<?php echo $tableName; ?>" available as properties of the model:
<?php else: ?>
 * There are no model relations.
<?php endif; ?>
<?php foreach($relations as $name=>$relation): ?>
 * @property <?php
	if (preg_match("~^array\(self::([^,]+), '([^']+)', '([^']+)'\)$~", $relation, $matches))
    {
        $relationType = $matches[1];
        $relationModel = $matches[2];

        switch($relationType){
            case 'HAS_ONE':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'BELONGS_TO':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'HAS_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            case 'MANY_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            default:
                echo 'mixed $'.$name."\n";
        }
	}
    ?>
<?php endforeach; ?>
 */
class <?php echo $modelClass; ?> extends <?php echo $this->baseClass; ?>
{

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
		return (string) $this-><?php
			$found = false;
			foreach($columns as $name => $column) {
				if(!$found
						&& $column->type != 'datetime'
						&& $column->type==='string'
						&& !$column->isPrimaryKey) {
					echo $column->name;
					$found = $column->name;
				}
			}

			// if the columns contains no column of type 'string', return the
			// first column (usually the primary key)
			if(!$found)
				echo reset($columns)->name;
			?>;

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '<?php echo $tableName; ?>';
	}
	/**
	* Define validation rules
	*/
	public function rules()
	{
		return array(
<?php
		foreach($rules as $rule) {
			echo "\t\t\t$rule,\n";
		}
?>
			array('<?php echo implode(', ', array_keys($columns)); ?>', 'safe', 'on'=>'search'),
		);
	}
	/**
	* Relation to other models
	*/
	public function relations()
	{
		return array(
<?php
		foreach($relations as $name=>$relation) {
			echo "\t\t\t'$name' => $relation,\n";
		}
?>
		);
	}
	/**
	* Attribute labels
	*/
	public function attributeLabels()
	{
		return array(
<?php
		foreach($labels as $name=>$label) {
			echo "\t\t\t'$name' => Yii::t('app', '$label'),\n";
		}
?>
		);
	}
	/**
	* Which attribute are safe for search
	*/
	public function search()
	{
		$criteria=new CDbCriteria;

<?php
		foreach($columns as $name=>$column)
		{
			if($column->type==='string' and !$column->isForeignKey)
			{
				echo "\t\t\$criteria->compare('$name', \$this->$name, true);\n";
			}
			else
			{
				echo "\t\t\$criteria->compare('$name', \$this->$name);\n";
			}
		}
		echo "\n";
?>
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => '<?php echo $found; ?> ASC',
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
