<?php
class EFormatter extends CFormatter {
	public function format($value,$type)
	{
		if (is_array($value)){
			$out = array();
			foreach ($value as $subval){
				$out[] = $this->format($subval, $type);
			}
			if (Yii::app() instanceof CWebApplication){
				if (count($out)) return "<ul><li>".implode("</li><li>", $out) . "</li></ul>";
			} elseif (Yii::app() instanceof CConsoleApplication){
				return implode(', ', $out);
			} else {
				return CVarDumper::dumpAsString($out);
			}
		} else return parent::format($value, $type);
	}
}