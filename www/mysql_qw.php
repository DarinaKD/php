<?php
## Простейшая функция для работы с placeholders.
// result-set mysql_qw($connection_id, $query, $argl, $arg2, ...)
//	— или -
// result-set mysql_qw($query, $argl, $arg2, ...)
// Функция выполняет запрос к MySQL через соединение, заданное как // $connection_id (если не указано, то через последнее открытое).
// Параметр $query может содержать подстановочные знаки ?,
// вместо которых будут подставлены соответствующие значения // аргументов $argl, $arg2 и т. д. (по порядку), экранированные и // заключенные в апострофы, 

function mysql_qw(){
$args = func_get_args();
$conn = null;
if(is_resource($args[0]))$conn = array_shift($args);
$query = call_user_func_array("mysql_make_qw",$args);	
return $conn!==null? mysql_query($query, $conn) : mysql_query($query);
}

function mysql_make_qw(){
$args = func_get_args();
$templ = &$args[0];
$templ = str_replace("%","%%",$templ);
$templ = str_replace("?","%s",$templ);
foreach($args as $i=>$v){
if(!$i)continue;
if(is_int($v))continue;
$args[$i] = "'".mysql_escape_string($v)."'";	
}
for($i=$c=count($args); $i<$c+20; $i++)
$args[$i+1]="UNKNOWN_PLACEHOLDER_$i";
return call_user_func_array("sprintf",$args);	
}


?>