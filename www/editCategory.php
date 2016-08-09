<?php
require_once "mysql_connect.php";
require_once "mysql_qw.php";
define("TBLNAME","CATEGORY");
if(@$_REQUEST['doAdd']){
$element=$_REQUEST['element'];
if(ini_get("magic_qoutes_gpc"))$element=array_map('stripslashes',$element);
if(isset($element[categoryID]))mysql_qw('INSERT INTO '.TBLNAME.' SET name=?, parentID=?',$element['name'],$element[categoryID])or die(mysql_error());
else mysql_qw('INSERT INTO '.TBLNAME.' SET name=?',$element['name'])or die(mysql_error());
HEADER("Location: {$_SERVER['SCRIPT_NAME']}?".time());
exit();
}

//if($delid = @$_REQUEST['delete'])mysql_qw('DELETE FROM '.TBLNAME.' WHERE id=?',$delid)or die(mysql_error());

$result = mysql_qw('SELECT * FROM '.TBLNAME)or die(mysql_error().$_SERVER['SCRIPT_NAME']);
$list = '<option ></option>';
while($row=mysql_fetch_assoc($result))
$list .='<option value='.$row['id'].'>'.$row['name'].'</option>'; 
?>
 <form action = "" method="post">
 <table>
	<tr valign=top>
	
		<td>Категория:</td>
		<td>  <select name="element[categoryID]" size="1" >
			<?=$list?>
	          </select> 
		</td>
		<td>Подкатегория:</td>
		<td><input type="text" name = "element[name]"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="doAdd" value="Добавить"></td>
	</tr>
</table>
</form>
<hr>
<hr>
