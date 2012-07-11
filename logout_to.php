<?
session_start();
include('template/dbsetup.php');

if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}


//connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);
//insert the login username, time, login/logout state into table:history
$maxuid;//declare the variable "$maxuid"
$sql = "SELECT (Max(uid)+1) FROM userloghis";
$result=mysql_query($sql);
list($maxuid) = mysql_fetch_row($result);
if($maxuid == 0){
	$maxuid = 1;
}
$logtime = date("Y-m-d H:i:s");//"2008-08-28 11:03:21"
$username = $_SESSION['username'];
$sql2="INSERT INTO userloghis (uid,username,logtime,state)
	VALUES ('$maxuid','$username','$logtime','logout')";
//echo $sql2;
mysql_query($sql2);	
session_destroy();
Header("Location:logout.php");
?>
