<?php

//here do not forget to check and format all data

$id = $_POST['id'];
$value = $_POST['value'];

/*
*Pay attention to info.php output, each div id is declared in that order: table_field_postID.
*This parameter sending via POST as "id", and that div value (innerHTML) is sending as "value"

*/
list($table, $field, $uid) = explode('_', $id);

//echo "Hello";
//echo $uid;

include('../template/dbsetup.php');
//Developed by elviscat
//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}

//select database
mysql_select_db($dbname);

//mysql query
mysql_query("UPDATE $table SET $field='$value' WHERE uid='$uid'");

//printing answer
$sql="SELECT $field FROM $table WHERE uid='$uid'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
//if username exists
if(mysql_num_rows($result)>0)
	echo $row[$field];
	//echo $value;

?>