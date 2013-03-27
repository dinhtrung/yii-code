<?php
/**
* This is the model base class for the table "block".
*
* Columns in table "block" available as properties of the model:
* @property string $bid
* @property string $title
* @property string $label
* @property string $label
* @property string $description
* @property integer $type
* @property string $option
* @property boolean $status
* @property integer $display
* @property string $url
*
* Relations of table "block" available as properties of the model:
* @property Blocktype $blocktype
* @property Blocktheme $themes
*/
class Block extends BaseActiveRecord
{
	// Add your model-specific methods here. This file will not be overriden by gtc except you force it.
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{block}}';
	}

	/*public function rules()
	{
		return array(
			array('title', 'required'),
			array('title, type, option, status, url, display', 'default', 'setOnEmpty' => true, 'value' => null),
			array('status, display', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('label', 'length', 'max'=>255),
			array('type', 'length', 'max'=>11),
			array('option, url, description', 'safe'),
			array('title, label, description', 'safe', 'on'=>'search'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'bid' => Yii::t('core', 'Bid'),
			'title' => Yii::t('core', 'Title'),
			'label' => Yii::t('core', 'Label'),
			'description' => Yii::t('core', 'Description'),
			'type' => Yii::t('core', 'Type'),
			'option' => Yii::t('core', 'Option'),
			'status' => Yii::t('core', 'Status'),
			'url' => Yii::t('core', 'Url'),
			'display' => Yii::t('core', 'Display'),
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('bid', $this->bid, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('label', $this->label, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('type', $this->type);
		$criteria->compare('option', $this->option, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('display', $this->display);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}*/

	public function init()
	{
		return parent::init();
	}

	public function __toString() {
		return (string) $this->title;

	}

	public function relations()
	{
		return array(
			'blocktype' => array(self::BELONGS_TO, 'Blocktype', 'type'),
			'themes' => array(self::HAS_MANY, 'Blocktheme', 'block'),
		);
	}

	public function attributeLabels(){
		return array_merge(parent::attributeLabels(),array(
			'blocktype'	=>	Yii::t('core', 'Blocktype'),
			'themes'	=>	Yii::t('core', 'Themes'),
		));
	}

	public function behaviors()
	{
		return array_merge(
			parent::behaviors(),
			array(
				'serializeOption'	=> array(
					'class' => 'ext.behaviors.CSerializeBehavior',
	 				'serialAttributes' => array('option'),
				)
			)
		);
	}

	public function defaultScope(){
		return array(
			'order'	=>	'title ASC',
		);
	}
	const DISPLAY_EXCEPT 	= 0;
	const DISPLAY_ONLY 		= 1;
	public static function displayOption($param = NULL) {
		$options = array(
			self::DISPLAY_EXCEPT	=>	Yii::t('core', "All pages except those listed "),
			self::DISPLAY_ONLY		=>	Yii::t('core', "Only the listed pages"),
		);
		if (is_null($param)) return $options;
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}

	public static function printOption($option){
		if (! is_array($option)) return $option;
		else{
			foreach ($option as $k => $v){
				$option[$k] = "$k: $v\n";
			}
			return implode("\n", $option);
		}
	}

	/**
	 * Render a block with settings retrieved from database
	 * @return string the HTML contents by renderPartial
	 */
	function render(){
		if (! $this->status) return;
		$requestUrl = Yii::app()->getRequest()->getPathInfo();
		if (! $requestUrl) $requestUrl = Yii::app()->setting->get('Website', 'homeUrl', '/site/index');
		if ($this->display == self::DISPLAY_ONLY){
			if (! self::matchPath($requestUrl, $this->url)){
				if (YII_DEBUG) return "<p class='highlight'>BLOCK {$this->title} NOT SHOWING HERE.</p>";
				else return '';
			}
		} elseif ($this->display == self::DISPLAY_EXCEPT){
			if (self::matchPath($requestUrl, $this->url)){
				if (YII_DEBUG) return "<p class='highlight'>BLOCK {$this->title} NOT SHOWING HERE</p>";
				else return '';
			}
		}
		try {
			if (is_null($this->blocktype)) return;
			$blockdata = array();
			if (! empty($this->blocktype->component)){
				$component = Yii::import($this->blocktype->component);
				if (is_array($this->option)){
					$blockdata = call_user_func_array(array($component, $this->blocktype->callback . 'Data'), $this->option);
				}
			}
			$blockdata["block"] = $this->getAttributes();
			return Yii::app()->getController()->renderPartial($this->blocktype->viewfile, $blockdata, TRUE);
		} catch (CException $e) {
			if (YII_DEBUG) return $e->getMessage();
		}
	}
	/**
	 * Drupal match Path
	 * Test to see if a block will be display in the matching pattern.
	 * TODO: Use Yii cache to store matching.
	 */
	public static function matchPath($path, $patterns) {
		// Convert path settings to a regular expression.
		// Therefore replace newlines with a logical or, /* with asterisks and the <front> with the frontpage.
		$to_replace = array(
		  '/(\r\n?|\n)/', // newlines
		  '/\\\\\*/', // asterisks
		  '/(^|\|)\\\\<front\\\\>($|\|)/', // <front>
		);
		$replacements = array(
		  '|',
		  '.*',
		  '\1' . preg_quote(Yii::app()->setting->get('Website', 'homeUrl', '/site/index'), '/') . '\2',
		);
		$patterns_quoted = preg_quote($patterns, '/');
		$regexp = '/^(' . preg_replace($to_replace, $replacements, $patterns_quoted) . ')$/';
		//CVarDumper::dump($regexp, 10, TRUE);
	  return (bool) preg_match($regexp, $path);
	}
	/**
	 * Removes all themes settings that are using this block.
	 * @see CActiveRecord::beforeDelete()
	 */
	protected function beforeDelete() {
		Blocktheme::model()->deleteAllByAttributes(array('block' => $this->bid));
		return parent::beforeDelete();
	}
}
