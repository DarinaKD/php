<?php
$user = "cook";
$pass = "cook";
$db = "cook";
 mysql_connect("cook.ua",$user,$pass) or die("Cannot connect database".mysql_error());
 /*@mysql_query("Create database $db");*/
 mysql_select_db($db) or die("Cannot select $db".mysql_error());
 /*$tbl = "category";
 $fld = "";
mysql_query("ALTER TABLE $tbl ADD INDEX ( $fld ) "); 
mysql_query("ALTER TABLE $tbl ADD INDEX ( $fld ) "); */
?>