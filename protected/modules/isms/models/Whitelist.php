<?php
/**
 * This is the model base class for the table "whitelist".
 *
 * Columns in table "whitelist" available as properties of the model:
 * @property integer $id
 * @property integer $fid
 * @property string $isdn
 *
 * Relations of table "whitelist" available as properties of the model:
 * @property Filter $f
 */
class Whitelist extends Blacklist {
	function tableName() {
		return '{{whitelist}}';
	}
}
