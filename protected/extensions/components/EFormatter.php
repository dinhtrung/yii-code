<?php
class EFormatter extends CFormatter {
	public function format($value,$type)
	{
		if (is_array($value)){
			$out = array();
			foreach ($value as $subval){
				$out[] = $this->format($subval, $type);
			}
			return (Yii::app() instanceof CWebApplication)?"<ul><li>".implode("</li><li>", $out) . "</li></ul>":implode(', ', $out);
		} else return parent::format($value, $type);
	}
}