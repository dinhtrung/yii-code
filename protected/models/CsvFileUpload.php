<?php
/**
 * 
 * @author dinhtrung
 *
 */
class CsvFileUpload extends CFormModel {
	public $files;
	public $filePath;
	public $fileHandle;
	public $delimiter = ',';
	public $enclosure = '"';
	public $escape = '\\';
	public $encode_from = 'auto';
	public $encode_to = 'UTF-8';
	
	public function rules(){
		return array(
			array('delimiter, enclosure, escape, encode_from, encode_to', 'safe'), 
		);
	}
	/**
	 * Return a list of all available encoding known by mb_string extension
	 * 
	 * @param string $val
	 * @return multitype:|Ambigous <>|NULL
	 */
	public static function encodeOptions($val = NULL){
		$options = array_combine(mb_list_encodings(), mb_list_encodings());
		if (is_null($val)) return  $options;
		elseif (in_array($val, $options)) return $options[$val];
		else return NULL;
	}
	
	/**
	 * Return an array with the header known...
	 * @return unknown
	 */
	public function getRawData(){
		$this->fileHandle = fopen($this->filePath, 'r');
		$line = 0;
		$header = fgetcsv($fh, 4096, $importModel->delimiter, $importModel->enclosure, $importModel->escape);
		foreach ($header as $k => $v)
			$header[$k] = @str_replace(array('-', '_', ' '), '', Transliteration::file(mb_convert_encoding($v, $importModel->encode_to, $importModel->encode_from)));

		// Process further if import is submit...
		if (isset($_POST['import'])){
			$line ++;
			if (empty($header) OR is_null($header[0])) Yii::log("The file uploaded must have the first row as header", 'error');
			else {
				while ($row = fgetcsv($fh, 4096, $importModel->delimiter, $importModel->enclosure, $importModel->escape)){
					$line++;
					if (count($row) != count($header)) Yii::trace("Data in line #$line is malformed...", 'error');
					else {
						foreach ($row as $k => $v){
							$attr[$header[$k]] = @mb_convert_encoding($v, $importModel->encode_to, $importModel->encode_from);
						}
						$rawData[] = $attr;
					}
				}
			}
		}
		fclose($this->fileHandle);
		return $rawData;
	}
	
	public function getHeader(){
		$this->fileHandle = fopen($this->filePath, 'r');
		$line = 0;
		$header = fgetcsv($fh, 4096, $importModel->delimiter, $importModel->enclosure, $importModel->escape);
		foreach ($header as $k => $v)
			$header[$k] = @str_replace(array('-', '_', ' '), '', Transliteration::file(mb_convert_encoding($v, $importModel->encode_to, $importModel->encode_from)));
		fclose($this->fileHandle);
		return $rawData;
	}
}