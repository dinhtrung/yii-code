<?php

/**
 * ECompositeUniqueKeyValidatable is the bahavior that attaches to ActiveRecord models
 * methods for validating uniqueness of composite keys.
 *
 * @link http://www.yiiframework.com/extension/composite-unique-key-validatable/
 * @author Sergey Sytsevich <laa513@gmail.com>
 */
class ECompositeUniqueKeyValidatable extends CActiveRecordBehavior {

    /**
     * @var array composite unique keys of a model
     */
    public $uniqueKeys;

    /**
     * @var bool Wheteher the $uniqueKeys property is already normalized
     */
    private $_normalized = false;

    /**
     * Saves old values of unique keys
     *
     * The old values are needed for validation when updating a model
     *
     * @param CEvent $event
     */
    public function afterFind($event) {
        $this->_normalizeKeysData();

        foreach ($this->uniqueKeys as &$uk) {
            $uk['oldValue'] = $this->_getUkValue($uk['attributes']);
        }
    }


    /**
     * Validates composite unique keys
     */
    public function validateCompositeUniqueKeys() {
        $this->_normalizeKeysData();
        
        $object = $this->getOwner();

        foreach ($this->uniqueKeys as $uk) {
            // check whether the validation of the current key should be skipped
            foreach ($uk['skipOnErrorIn'] as $skipAttr) {
                if ($object->getError($skipAttr)) {
                    continue 2;
                }
            }

            $criteria = new CDbCriteria();
            foreach ($uk['attributes'] as $attr) {
                $criteria->compare($attr, $object->$attr);
            }

            /*
             * if an object is a new record or if it is an old record with modified unique key value,
             * then the key should be unique ($criteriaLimit = 0)
             *
             * if we are updating an existing record without changes of unique key attributes,
             * then we should allow 1 existing record satisfying the criteria
             */
            $ukIsChanged = !$object->isNewRecord
                           && ($uk['oldValue'] != $this->_getUkValue($uk['attributes']));
            $criteriaLimit = ($object->isNewRecord || $ukIsChanged) ? 0 : 1;

            if (CActiveRecord::model(get_class($object))->count($criteria) > $criteriaLimit) {
                foreach ($uk['errorAttributes'] as $attr) {
                    $object->addError($attr, $uk['errorMessage']);
                }
            }
        }
    }


    /**
     * [column => value] map representing value of a composite unique key
     *
     * @return array
     */
    public function _getUkValue($attributes) {
        $ukValue = array();
        foreach ($attributes as $attr) {
            $ukValue[$attr] = $this->getOwner()->$attr;
        }

        return $ukValue;
    }


    /**
     * Normalize unique keys
     */
    private function _normalizeKeysData() {
        if ($this->_normalized) {
            return;
        }

        if (!is_array($this->uniqueKeys)) {
            throw new CException('Wrong unique keys format in the '
                                 . get_class($this->getOwner()) . ' model');
        }

        // when only one unique key is declared
        if (!is_array(current($this->uniqueKeys))) {
            $this->uniqueKeys = array($this->uniqueKeys);
        }

        // convert comma separated lists to arrays
        foreach ($this->uniqueKeys as &$uk) {
            isset($uk['attributes']) or $uk['attributes'] = array();
            is_array($uk['attributes']) or $this->_stringListToArray($uk['attributes']);
            
            // *nonexistent attribute* means that the error message will appear,
            // but it will not be attached to a certain property
            isset($uk['errorAttributes']) or $uk['errorAttributes'] = array('*nonexistent attribute*');
            is_array($uk['errorAttributes']) or $this->_stringListToArray($uk['errorAttributes']);

            isset($uk['skipOnErrorIn']) or $uk['skipOnErrorIn'] = array();
            is_array($uk['skipOnErrorIn']) or $this->_stringListToArray($uk['skipOnErrorIn']);
        }

        $this->_normalized = true;
    }


    /**
     * Convert comma separated list to array
     *
     * @param string $list
     */
    private function _stringListToArray(&$list) {
        $list = explode(',', $list);
        foreach ($list as &$item) {
            $item = trim($item);
        }
    }

}