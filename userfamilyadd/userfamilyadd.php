<?php 
session_start();
include('../template/dbsetup.php');
//security concern
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}

//Developed by elviscat
//08/09/2008
//get the posted values
$family_name = htmlspecialchars($_POST['family_name'],ENT_QUOTES);
$family_desc = htmlspecialchars($_POST['family_desc'],ENT_QUOTES);
//declare the other variables
$user_name = $_SESSION['username'];
$init_time = date("Y-m-d H:i:s");//"2008-08-28 11:03:21"
$expire_time = date("2009-10-10 00:00:00");
//connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);
//mysql query
$sql = "SELECT (Max(cfid)+1) FROM cfamily";
$result = mysql_query ($sql) or die ("Invalid query");
list($maxcfid) = mysql_fetch_row($result);
if($maxcfid == 0){
	$maxcfid = 1;
}
//INSERT a new row into TABLE:cfamily
$sql2="INSERT INTO cfamily (cfid,family_name,owner,family_desc,init_time,expire_time,state)
VALUES ('$maxcfid','$family_name','$user_name','$family_desc','$init_time','$expire_time','proposed')";
echo $sql2;
$result2 = mysql_query ($sql2) or die ("Invalid query");
//mysql connection close
mysql_close($link);

?>