<?php
require_once "mysql_connect.php";
require_once "mysql_qw.php";
define("TBLNAME","CATEGORY");
/*if(@$_REQUEST['doAdd']){
$element=$_REQUEST['element'];
if(ini_get("magic_qoutes_gpc"))$element=array_map('stripslashes',$element);
mysql_qw('INSERT INTO '.TBLNAME.' SET name=?, text=?',$element['name'],$element['text'])or die(mysql_error());
HEADER("Location: {$_SERVER['SCRIPT_NAME']}?".time());
exit();
}

if($delid = @$_REQUEST['delete'])mysql_qw('DELETE FROM '.TBLNAME.' WHERE id=?',$delid)or die(mysql_error());*/
class NavMenu {
	public $listTree='';
	private	$arrmenuIdName=array();
	private	$arrmenuIdPartId=array();

	function __construct($result){
//	for(this->arrmenu=array(); $row=mysql_fetch_array($result); this->arrmenu[]=$row);
		while($row=mysql_fetch_array($result)){
			$this->arrmenuIdName[$row['id']]=$row['name'];
			$this->arrmenuIdPartId[$row['id']]=$row['parentID'];		
		}
	}
 public	function printTree(){
		 $this->getSubMenu(null);
		 echo $this->listTree;
	//	 return $this->listTree;
   } 
 private function getSubMenu($parent){  
      $arr = array_keys($this->arrmenuIdPartId,$parent);
      if($parent!=null && count($arr))$this->listTree .=' <ul> '; 
      foreach($arr as $el){
			$this->listTree .=' <li><a href="#'.$el.'">'.$this->arrmenuIdName[$el].'</a>';
			if(!$this->getSubMenu($el))$this->listTree .='</li> ';
		}
	   if(count($arr)>0 && $parent!=null)$this->listTree .=' </ul></li> '; 
	 	   return count($arr);
	 }
}
	
$result = mysql_qw('SELECT id, name, parentID FROM '.TBLNAME.' ORDER BY ParentID')or die(mysql_error());
 //for($book=array(); $row=mysql_fetch_array($result); $book[]=$row);
$NavMenu = new NavMenu($result);
$NavMenu->printTree();
?>