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


$uid = $_GET['uid'];
if($uid == $_SESSION['uid']){
	$update_sql = "UPDATE user SET photo = '' WHERE uid ='".$uid."'";
	//echo "\$update_sql is".$update_sql."<BR />\n";
	mysql_query($update_sql);	
	//Header("Location:userprofileedit.php?uid=".$uid);
	Header("Location:userprofileedit.php");
}else{
	echo "session uid is not matching to get uid!<BR />\n";
	echo "Back to your <a href=\"userprofileedit.php\">personal information page</a>\n";
}
?>
