<?php
/**
 * ActiveDateList class file.
 *
 * @author ciss
 * @link http://www.yiiframework.com/
 *
 * 
 * ActiveDateList creates dropdown lists from a date string.
 * For configuration examples, please see the examples for the $displayFormat property.
 *
 * Before validating your date property you will have to attach an event handler to your model.
 * This can be done as follows:
 *
 *   $model = new myModel;
 *   ActiveDateList::sanitize($model, 'myDateAttribute');
 *
 * or
 *
 *   $record = myModel::model()->find(...);
 *   ActiveDateList::sanitize($record, 'myDateAttribute');
 *
 * This applies a handler to the model's onBeforeValidation event.
 * The handler will merge the select fields back into a single string before validation occurs.
 *
 */
class ActiveDateList extends CInputWidget
{
	/**
	 * @var string the locale ID (e.g. 'fr', 'de') for the language to be used by the select fields.
	 * If not set, this property defaults to the application language. To prevent this, set it to false.
	 */
	public $language;

	/**
	 * @var string the format of $startDate, $endDate and the attribute value, using the date() syntax.
	 */
	public $inputFormat = 'Y-m-d';
	
	/**
	 * @var string the earliest selectable date. Format must conform to the specified input format.
	 */
	public $startDate;
	
	/**
	 * @var string the latest selectable date. Format must conform to the specified input format.
	 */
	public $endDate;

	/**
	 * @var boolean wether options should be sorted by their values.
	 * When using very short time spans (a couple of months) this may not be a desired behaviour.
	 */
	public $keySort = true;
	
	/**
	 * @var array the select boxes to be displayed.
	 * Each entry consists of an index defining the value format and a value defining the display format.
	 * Make sure that the index is a substring of your defined input format, otherwise the values can't be merged back into a string.
	 * Example: with inputFormat = "Y-m-d", having an index format "m-d" or "Y-m" will work; "d-m" or "Y/m" will not.
	 *
	 * Usage examples (assuming the default input format is used; "output" is an ascii representation of the generated select boxes):
	 * <pre>
	 *   Config: array('d' => 'd', 'm' => 'F', 'Y' => 'Y')
	 *   Output: [03 |] [April |] [2010 |]
	 * 
	 *   Config: array('m-d' => 'l, F j', 'Y' => Y')
	 *   Output: [Saturday, April 3 |] [2010 |]
	 * 
	 *   Config: array('Y-m-d' => 'M/d/y')
	 *   Output: [Apr/03/10 |]
	 * </pre>
	 */
	public $displayFormat = array('m-d' => 'F jS', 'Y' => 'Y');

	/**
	 * @var string the template the boxes should be wrapped in.
	 * Recognizes numerical and value format placeholders and allows mixing of both.
	 * If null, the boxes will be joined together using the $separator property.
	 * Example: '<div><span class="first-select">{0}</span> <span class="year-select">{Y}</span></div>'
	 */
	public $template;
	
	/**
	 * @var string separator between select boxes.
	 * Will only be used if no template has been defined.
	 */
	public $separator = ' ';
	

	private $_localizableFormats = array(
		'D' => array('substitute' => '{\D:w}', 'function' => 'getWeekDayName',	'format' => 'abbreviated'),
		'l' => array('substitute' => '{\l:w}', 'function' => 'getWeekDayName',	'format' => 'wide'),
		'M' => array('substitute' => '{\M:n}', 'function' => 'getMonthName',		'format' => 'abbreviated'),
		'F' => array('substitute' => '{\F:n}', 'function' => 'getMonthName',		'format' => 'wide'),
	);


	/**
	 * Creates a timestamp from the given format and value.
	 * Though this function is not as versatile as strtotime(), it is still better suited for non-english date formats.
	 * Recognized formatting options are d, j, m, n, y and Y.
	 */
	public static function getTimestamp($format, $value)
	{
		$patterns = array(
			'Y' => '(?<Y>[1-2][0-9][0-9][0-9])',
			'y' => '(?<y>[0-9][0-9])',
			'd' => '(?<d>0[1-9]|[12][0-9]|3[01])',
			'j' => '(?<j>[1-9]|[12][0-9]|3[01])',
			'S' => '(?<S>(?<=1)st|(?<=2)nd|(?<=3)rd|(?<=[4-0])th)',
			'm' => '(?<m>0[1-9]|1[0-2])',
			'n' => '(?<n>[1-9]|1[0-2])',
		);

		$mappers = array(
			'j'=>'j',
			'd'=>'j',
			'n'=>'n',
			'm'=>'n',
			'Y'=>'Y',
			'y'=>'Y'
		);
		
		$formatPattern = '/^' . strtr(preg_quote($format), $patterns) . '$/';
		if(!preg_match($formatPattern, $value, $date))
			return false;
		
		$date += array('j' => 0, 'n' => 0, 'Y' => 0);
		
		foreach($mappers as $from => $to)
			if(!empty($date[$from]))
				$date[$to] = $date[$from];
		
		return mktime(12, 0, 0, (int) $date['n'], (int) $date['j'], (int) $date['Y']);
		
	}

	
	/**
	 * Replaces localizable formatters with placeholders.
	 */
	private function replaceLocalizableFormats($formatStrings, $falseIfNoChange = false)
	{
		$unchanged = true;
		$replacements = array();
		foreach($this->_localizableFormats as $format => $options)
			$replacements[$format] = $options['substitute'];
		
		$replacedStrings = array();	
		foreach($formatStrings as $index => $string)
		{
			$replacedStrings[$index] = strtr($string, $replacements);
			$unchanged = $falseIfNoChange && $unchanged && $replacedStrings[$index] === $string;
		}
		
		return $unchanged ? false : $replacedStrings;
	}	

	
	/**
	 * Replaces name placeholders with their localized names.
	 */
	private function localize($data)
	{
		$locale = CLocale::getInstance($this->language);
		$locOptions = $this->_localizableFormats;
		$formats = implode('', array_keys($locOptions));
		foreach($data as &$field)
			foreach($field as &$string)
			{
				if(strstr($string, '{') === false)
					// nothing to replace, break loop
					break;
				preg_match_all("/\{(?<format>[$formats]):(?<index>.+?)\}/", $string, $matches, PREG_SET_ORDER);
				foreach($matches as $match)
				{
					$method = $locOptions[$match['format']]['function'];
					$nameFormat = $locOptions[$match['format']]['format'];
					$string = str_replace($match[0], $locale->$method($match['index'], $nameFormat), $string);
				}
			}
		return $data;
	}

	
	private function createDropDownLists()
	{
		list($name, $id) = $this->resolveNameID();
		
		$currentStamp	= self::getTimestamp($this->inputFormat, $this->model->{$this->attribute});
		$startStamp		= self::getTimestamp($this->inputFormat, $this->startDate);
		$endStamp			= self::getTimestamp($this->inputFormat, $this->endDate);

		// alter name formatters for localized substitution
		if(!empty($this->language))
		{
			$localize = $this->replaceLocalizableFormats($this->displayFormat, true);
			if($localize !== false)
			{
				$this->displayFormat = $localize;
				$localize = true;
			}
		}
		else
			$localize = false;
		
		$step = 60*60*24;
		$data = array();
		
		// fill the options lists
		for($i = $startStamp; $i < $endStamp; $i = $i + $step)
			foreach($this->displayFormat as $valueFormat => $displayFormat)
				$data[$valueFormat][date($valueFormat, $i)] = date($displayFormat, $i);

		if($localize === true)
			$data = $this->localize($data);
		
		// preselect current date, sort item lists and generate dropdown lists
		$dropDownLists = array();
		foreach($this->displayFormat as $valueFormat => $displayFormat)
		{
			$selected[$valueFormat] = date($valueFormat, $currentStamp);
			if(!empty($this->keySort))
				ksort($data[$valueFormat], SORT_REGULAR);
			
			$htmlOptions = array('id' => CHtml::getIdByName($name."[$valueFormat]")) + $this->htmlOptions;
			$dropDownLists[$valueFormat] = CHtml::dropDownList($name."[$valueFormat]", $selected[$valueFormat], $data[$valueFormat], $htmlOptions);
		}
		
		return $dropDownLists;	
	}
	
	
	public function init()
	{
		parent::init();
		
		if($this->language === null && Yii::app()->language !== Yii::app()->sourceLanguage)
			$this->language = Yii::app()->language;
	}
	
	
	/**
	 * The actual handler attached to the model's onBeforeValidate event.
	 */
	public static function conversionHandler($event, $attribute)
	{
		$value = &$event->sender->$attribute;
		if(is_string($value))
			return true;
		
		if(empty($value['inputFormat']))
		{
			$value = null;
			return false;
		}
		
		$value = strtr($value['inputFormat'], (array) $value);
		return true;
	}
	
	
	/**
	 * Attaches an event handler to the model's onBeforeValidate event.
	 * This handles merging values returned by the dropdown lists back into a single string.
	 */
	public static function sanitize($model, $attributes)
	{
		$model->attachEventHandler('onBeforeValidate', create_function('$event', 'return ' . __CLASS__ . "::conversionHandler(\$event, $attributes);"));
	}
	
	
	public function run()
	{
		list($name) = $this->resolveNameID();
		echo CHtml::hiddenField($name.'[inputFormat]', $this->inputFormat);

		$lists = $this->createDropDownLists();

		if($this->template !== null)
		{
			$tokens = array();
			foreach(array_keys($lists) as $index => $key)
			{
				$tokens['{'.$index.'}'] = &$lists[$key];
				$tokens['{'.$key.'}'] = &$lists[$key];
			}
			echo strtr($this->template, $tokens);
		}
		else
			echo implode($this->separator, $lists);
	}
}