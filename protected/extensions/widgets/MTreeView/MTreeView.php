<?php

/**
 * @author Morris Jencen O. Chavez <macinville@gmail.com>
 * @license http://www.yiiframework.com/license/
 */

/**
 * MTreeView extends CTreeView, which displays a tree view of hierarchical data.
 * It can handle both nested set and adjacency hierarchy model. It also creates
 * link and adds icon if available.
 *
 *
 *
 * References (aside from Yii docs):
 * http://stackoverflow.com/questions/841014/nested-sets-php-array-and-transformation
 * http://semlabs.co.uk/journal/converting-nested-set-model-data-in-to-multi-dimensional-arrays-in-php
 * http://www.fliquidstudios.com/2008/12/23/nested-set-in-mysql/
 * http://snipplr.com/view/4383/build-nested-array-from-sql/
 */
class MTreeView extends CTreeView{

	private $_tree;
	private $_menus;
	private $_fields_adjacency=array(
	'id'=>'id',
	'text'=>'text',
	'url'=>'url',
	'icon'=>'icon',
	'alt'=>'alt',
	'tooltip'=>'tooltip',
	'id_parent'=>'id_parent',
	'task'=>'task',
	'position'=>'position'
	);
	private $_fields_nested=array(
	'id'=>'id',
	'text'=>'text',
	'url'=>'url',
	'icon'=>'icon',
	'alt'=>'alt',
	'tooltip'=>'tooltip',
	'task'=>'task',
	'lft'=>'lft',
	'rgt'=>'rgt',
	);

	public $assets;
	public $boldCurrent=true;
	public $conditions=array('1=1');
	public $fields;
	public $hierModel;
	public $table;
	public $template="{icon}{text}";

	//static variables for AJAX
	public static $_assetsPath_;
	public static $_boldCurrent_=true;
	public static $_template_="{icon}{text}";
	/**
	 * Initializes the widget.
	 * This method registers all needed client scripts and renders
	 * the tree view content.
	 */
	public function init(){
		if(isset($this->htmlOptions ['id']))
		$id=$this->htmlOptions ['id'];
		else
		$id=$this->htmlOptions ['id']=$this->getId();
		if($this->url!==null)
		$this->url=CHtml::normalizeUrl($this->url);
		$cs=Yii::app()->getClientScript();
		$cs->registerCoreScript('treeview');
		$options=$this->getClientOptions();
		$options=$options===array() ? '{}' : CJavaScript::encode($options);
		$cs->registerScript('Yii.CTreeView#'.$id,"jQuery(\"#{$id}\").treeview($options);");
		if($this->cssFile===null)
		$cs->registerCssFile($cs->getCoreScriptUrl().'/treeview/jquery.treeview.css');
		else if($this->cssFile!==false)
		$cs->registerCssFile($this->cssFile);
		echo CHtml::tag('ul',$this->htmlOptions,false,false)."\n";

		if(!isset($this->assets))
			$this->assets=dirname(__FILE__).'/'.'assets';
		if($this->_fields_adjacency['icon'] || $this->_fields_nested['icon'])
			self::$_assetsPath_=Yii::app()->getAssetManager()->publish($this->assets);
		self::$_template_=$this->template;
		self::$_boldCurrent_=$this->boldCurrent;
		echo $this->getData();
	}

	public function getData(){
		if(!isset($this->_tree)){
			$refs=array();
			$list=array();

			switch($this->hierModel){
				case 'adjacency':
					$this->queryAdjacentMenu();
					break;
				case 'nestedSet':
					$this->queryNestedSet();
					break;
			}
		}
		echo self::saveDataAsHtml($this->_tree);
	}

	private function queryAdjacentMenu(){
		$fields=$this->getFields();
		$conditions=$this->getConditions();
		$this->_menus=Yii::app()->db->createCommand()
		// echo Yii::app()->db->createCommand()
		->select($fields)
		->from($this->table)
		->where($conditions[0],$conditions[1])
		->order($this->_fields_adjacency['position'])
		->queryAll();
		$this->getAdjacentTree($this->_menus);
	}

	private function queryNestedSet(){
		$fields=$this->getFields();
		//	echo $fields;
		$conditions=$this->getConditions();
		$this->_menus=Yii::app()->db->createCommand()
		->select($fields)
		->from($this->table.' AS t1,'.$this->table.' AS t2')
		->where($conditions[0],$conditions[1])
		->group('t1.'.$this->fields['text'])
		->order('t1.'.$this->_fields_nested['lft'])
		->queryAll();
		$this->getNestedTree($this->_menus);
	}

	private function getAdjacentTree($menu){
		foreach($menu as $data){
			if($this->_fields_adjacency['task'])
			if(isset($data ['task']))
			if(!Yii::app()->user->checkAccess($data ['task']))
			continue;

			$thisref=&$refs [$data ['id']];
			$thisref ['id']=$data ['id'];
			$thisref ['text']=$this->formatTreeLinks($data ['text'],$this->_fields_adjacency['url'] ? $data ['url'] : '',$this->_fields_adjacency['icon'] ? $data ['icon'] : NULL,$this->_fields_adjacency['tooltip'] ? $data ['tooltip'] : NULL,$this->_fields_adjacency['alt'] ? $data['alt'] : '');


			if($data ['id_parent']==0){
				$list [$data ['id']]=&$thisref;
			}
			else{
				$refs [$data ['id_parent']] ['children'] [$data ['id']]=&$thisref;
			}
		}
		$this->_tree=$list;
	}

	private function getNestedTree($menu){
		// Trees mapped
		$list=array();
		$l=0;

		if(count($menu)>0){
			// Node Stack. Used to help building the hierarchy
			$stack=array();

			foreach($menu as $node){
				$item=$node;
				$item['children']=array();
				$item['text']=$this->formatTreeLinks($item ['text'],$item ['url'],$this->_fields_nested['icon'] ? $item ['icon'] : NULL,$this->_fields_nested['tooltip'] ? $item ['tooltip'] : NULL,$this->_fields_nested['alt'] ? $item['alt'] : '');

				// Number of stack items
				$l=count($stack);

				// Check if we're dealing with different levels
				while($l>0&&$stack[$l-1]['depth']>=$item['depth']){
					array_pop($stack);
					$l--;
				}

				// Stack is empty (we are inspecting the root)
				if($l==0){
					// Assigning the root node
					$i=count($list);
					$list[$i]=$item;
					$stack[]=& $list[$i];
				}
				else{
					// Add node to parent
					$i=count($stack[$l-1]['children']);
					$stack[$l-1]['children'][$i]=$item;
					$stack[]=& $stack[$l-1]['children'][$i];
				}
			}
		}
		$this->_tree=$list;
	}

	private function getFields(){
		$fields=array();
		if(!empty($this->fields)){
			switch($this->hierModel){
				case 'adjacency':
					$_fields=$this->_fields_adjacency;
					foreach($_fields as $field=>$val){
						if(isset($this->fields[$field])){
			    $this->_fields_adjacency[$field]=$this->fields[$field];
			    if(is_bool($this->fields[$field])){
			    	if($this->fields[$field])
				    $fields[]=$field;
			    }
			    elseif(is_string($this->fields[$field]))
			    $fields[]=$this->fields[$field].' AS '.$field;
						}
						else
						$fields[]=$field;
					}
					break;
				case 'nestedSet':
					$_fields=$this->_fields_nested;
					foreach($_fields as $field=>$val){
						if(isset($this->fields[$field])){
			    $this->_fields_nested[$field]=$this->fields[$field];
			    if(is_bool($this->fields[$field])){
			    	if($this->fields[$field])
				    $fields[]='`t1`.`'.$field.'`';
			    }
			    elseif(is_string($this->fields[$field]))
			    $fields[]='`t1`.`'.$this->fields[$field].'` AS `'.$field.'`';
						}
						else
						$fields[]='`t1`.`'.$field.'`';
					}
					$text=isset($this->fields['text']) ? $this->fields['text'] : $this->_fields_nested['text'];
					$fields['depth']='(COUNT( `t2`.`'.$text.'` ) -1) AS `depth`';
					break;
			}
		}
		else{
			switch($this->hierModel){
				case 'adjacency':
					$fields=$this->_fields_adjacency;
					break;
				case 'nestedSet':
					$fields=$this->_fields_adjacency;
					$fields['depth']='(COUNT( t2.'.$text.' ) -1) AS depth';
					break;
			}
		}
		return implode(', ',$fields);
	}

	private function getConditions(){
		$conditions=array();
		if($this->hierModel=='adjacency')
		$conditions[]=$this->conditions[0];
		else
		$conditions[]=$this->conditions[0].' AND (t1.'.$this->_fields_nested['lft'].
		    ' BETWEEN t2.'.$this->_fields_nested['lft'].' AND t2.'.
		$this->_fields_nested['rgt'].')';
		if(isset($this->conditions[1])){
			$conditions[]=$this->conditions[1];
		}
		else
		$conditions[]=array();
		return $conditions;
	}

	public static function formatTreeLinks($text,$url='',$icon=NULL,$tooltip=NULL,$alt=''){
		$style='';
		$img="";
		if($icon)
		$img=CHtml::image(self::$_assetsPath_.'/'.$icon,$alt);

		if(strlen($url)&&self::$_boldCurrent_)
		if(self::sameUrl($url))
		$style="style='font-weight:bold'";

		$title=str_replace('{icon}',$img,self::$_template_);
		$title=str_replace('{text}',$text,$title);

		$node = sprintf('<span %s %s>%s</span>',isset($tooltip) ? "title='".$tooltip."'" : '',$style,strlen($url)==0 ? $title : CHtml::link($title,Yii::app()->createUrl($url)));
		return $node;
	}

	private static function sameUrl($url){
		if(strpos(Yii::app()->request->url,$url))
		return true;
		return false;
	}

	/**
	 * Saves tree view data in JSON format.
	 * This method is typically used in dynamic tree view loading
	 * when the server code needs to send to the client the dynamic
	 * tree view data.
	 * @param array $data the data for the tree view (see {@link data} for possible data structure).
	 * @return string the JSON representation of the data
	 */
	public static function saveDataAsJson($data){
		$arrData=array();
		foreach($data AS $key){
			$url = isset($key['url']) ? $key['url']:'';
			$icon = (isset($key['icon']) && isset(self::$_assetsPath_)) ? $key['icon']:NULL;
			$tooltip = isset($key['tooltip']) ? $key['tooltip']:NULL;
			$alt = isset($key['alt']) ? $key['alt']:'';

			$key['text']=self::formatTreeLinks($key['text'],$url,$icon,$tooltip,$alt);
			$arrData[]=$key;
		}

		if(empty($arrData))
		return '[]';
		else
		return CJavaScript::jsonEncode($arrData);
	}
}
