<?php
 /*
  *This extension requires a column for versioning and one to reference the parent/original record. Each new version is a new record but they all share the same parent_id, which is the primary key value of the initial record. Below is an example table definition:

   $this->createTable('email', array(
            'id'            => 'int(11) NOT NULL AUTO_INCREMENT',
            'parent_id'     => 'int(11),
            'version'       => 'int(11) DEFAULT 1',
            'title'         => 'string NOT NULL',
            'body'          => 'string NOT NULL',
            'created_time'  => 'timestamp DEFAULT \'0000-00-00 00:00:00\'',
        ));
To use this extension, just copy this file to your extensions/ directory, add 'import' => 'application.extensions.EActsAsVersioned', [...] to your config/main.php and add this behavior to each model you would like to inherit the new functionalities:

public function behaviors(){
      return array( 'EActsAsVersioned' => array(
            'class' => 'application.extensions.EActsAsVersioned'));
}

If you decide to use different column names you can define them as follows (Note that the values shown here are default!)

public function behaviors(){
      return array( 'EActsAsVersioned' => array(
            'class'              => 'application.extensions.EActsAsVersioned')
            'parentIdColumnName' => 'parent_id' ;
            'versionColumnName'  => 'version' ;

The examples below assume the versioning behavior is added to an Email model
getCurrent($parent_id=null)

Load all current models or just one:

$emails = Email::model()->getCurrent() ;   // all current models
$email  = Email::model()->getCurrent(10) ; // load current model with parent_id = 10

it returns an array of Emails or one Email object
getVersions( $criteria=array(), $params=null ) ;

This method is called on an Email instance and loads all related versions or a subset depending on the $criteria

$versionList = $email->getVersions() ; // returns an array with version numbers
output:
     Array
     (
        [0] => 1
        [1] => 2
        [2] => 3
     )
$emails = $email->getVersions(
    array(   // criteria
       'toModels'  => true,
       'condition' =>'created_time >:created'
    ),array( // params
       ':created'=>$someTime
    )
));

With the toModels criteria set to TRUE the returned array contains Email objects instead of version numbers
getVersion($version)

Load a specific version:

$email = Email::model()->getCurrent(1)->getVersion(8) ;
$email = $email->getVersion(21) ;
$current = $email->getCurrent() ; // load current version of $email

reuse()

If you plan to use the same instance multiple times to create different versions, like:

$email->title = 'barfoo' ;
$email->save() ;
$email->title = 'foobar' ;
$email->save(false) ;

without validation, it will not work. To fix this call reuse() before save(), like:

$email->reuse() ;
$email->save(false) ;

Other functionalities

$nextEmail = $someEmail->getNextVersion() ; // returns null if not exist
$prevEmail = $someEmail->getPreviousVersion() ;
if ( $someEmail->isCurrent() ) { ... }
 */

class EActsAsVersioned extends CActiveRecordBehavior
{
	public $parentIdColumnName = 'parent_id' ;
	public $versionColumnName  = 'version' ;
	public $timestampColumn    = 'created_time' ;
	public $memIsNewRecord ;

	public function reuse() {
		$this->memIsNewRecord = $this->owner->getIsNewRecord() ;
		$this->owner->setIsNewRecord(TRUE) ;	 	 // Make it an INSERT
		$this->owner->primaryKey = NULL ;		 // New record
	}
	public function beforeSave()
	{
		$owner = $this->getOwner() ;
		if ( !$this->memIsNewRecord) {  // current version required
			$owner->{$this->versionColumnName} = $owner->getCurrent()->{$this->versionColumnName} + 1 ;
		}
		else {
			$owner->{$this->parentIdColumnName} = $this->owner->primaryKey ; // New record: id = parent_id
		}
	}

	public function afterValidate() {
		if ( !$this->owner->getIsNewRecord() )
			$this->reuse() ;
	}
	public function afterConstruct() {
		$this->reuse() ;
	}
	public function afterFind() {
		$this->reuse() ;
	}

	public function afterSave() {
		$owner = $this->getOwner() ;
		if ( $this->getOwner()->{$this->parentIdColumnName} == null) {
			$sql = sprintf( 'UPDATE %s SET %s = %d WHERE %s = %d',
				$owner->tableName(),
				$this->parentIdColumnName,
				$owner->primaryKey,
				$owner->getTableSchema()->primaryKey,
				$owner->primaryKey ) ;
			$owner->dbConnection->createCommand( $sql )->execute() ;
			$owner->{$this->parentIdColumnName} = $this->owner->primaryKey ;
		}
		$this->memIsNewRecord = FALSE ; // not a new record anymore
	}

	public function getCurrent($parent_id = null) {
		$owner = $this->getOwner() ;
		if ( !isset($parent_id) )
			$parent_id = isset($owner->{$this->parentIdColumnName}) ? $owner->{$this->parentIdColumnName} : null ;

		// select all current versions. The sub-query garentees that the highest version number is first ordered
		$sql = sprintf('SELECT * FROM (SELECT * FROM %s ORDER BY  %s DESC) r1 WHERE %s > 0',
				$owner->tableName(),
				$this->versionColumnName,
				$this->parentIdColumnName) ;

		// if set, load current version for a specific parent_id
		if ( isset($parent_id) )
			$sql .= sprintf( ' AND %s = :parent_id', $this->parentIdColumnName ) ;

		$sql .= '  GROUP BY r1.' . $this->parentIdColumnName ; // only take the current version (record with highest version number)

		$command = $owner->dbConnection->createCommand($sql) ;

		if ( isset($parent_id) )
			$command->bindValue(':parent_id', $parent_id, PDO::PARAM_INT);

		$models = $command->queryAll() ;
		if ( isset($parent_id) ) {
			return sizeof($models) == 1 ? $owner->populateRecord($models[0]) : null ;
		}
		else {
			if ( sizeof($models) > 0 )
				return $owner->populateRecords($models) ;
			else
				return array() ;
		}
	}

	public function getVersions( $criteria = array(), $params = null ) {
		$owner = $this->getOwner() ;

		if ( isset($owner->{$this->parentIdColumnName}) ) {

			$sql = sprintf( 'SELECT * FROM %s WHERE %s = :parent_id',
					$owner->tableName(),
					$this->parentIdColumnName) ;

			if ( isset($criteria['condition']) )
				$sql .= sprintf(' AND (%s)', $criteria['condition']) ;

			$sql .= sprintf( ' ORDER BY %s ASC', $this->versionColumnName ) ;

			$command = $owner->dbConnection->createCommand($sql) ;
			$command->bindValue(':parent_id', $owner->{$this->parentIdColumnName}, PDO::PARAM_INT);
			if ( isset($params) ) {
	                	foreach( $params as $key => $value ) {
                        		$command->bindValue($key, $value);
                		}
			}

			$versionList = $command->queryAll() ;

			$output = array() ;
			if ( isset($criteria['toModels']) && $criteria['toModels'] == true )
				$output = $owner->populateRecords($versionList) ;
			else {
				foreach( $versionList as $key => $value)  {
					$output[] = $value[$this->versionColumnName] ;
				}
			}
			return $output ;
		}
		return null ; // not for static usage
	}

	public function getVersion($version) {
		$model =  $this->getVersions( array('condition'=> $this->versionColumnName . ' = ' .$version, 'toModels'=>true) ) ;
		if ( sizeof($model) == 1 )
			return $model[0] ;
		else
			return null ;
	}

	public function getNextVersion() {
		return $this->getVersion( $this->getOwner()->{$this->versionColumnName} + 1 ) ;
	}
	public function getPreviousVersion() {
		return $this->getVersion( $this->getOwner()->{$this->versionColumnName} - 1 ) ;
	}
	public function isCurrent() {
		return $this->getOwner()->getNextVersion() == null ;
	}
}
