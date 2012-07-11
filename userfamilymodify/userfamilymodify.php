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
$cfid = htmlspecialchars($_POST['cfid'],ENT_QUOTES);
$family_name = htmlspecialchars($_POST['family_name'],ENT_QUOTES);
$family_desc = htmlspecialchars($_POST['family_desc'],ENT_QUOTES);
//declare the other variables
$user_name = $_SESSION['username'];

//connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);
//mysql query
//Update a existing row into TABLE:cfamily
$sql="UPDATE cfamily SET family_name = '".$family_name."',family_desc='".$family_desc."' WHERE owner = '".$user_name."' AND cfid='".$cfid."'";
echo $sql;
$result = mysql_query ($sql) or die ("Invalid query");
//mysql connection close
mysql_close($link);

?>