<?
/******************************
**	authoraccountupdate.php
**	elviscat@gmail.com
**  Elvis Wu
**  09/20/2008
**  version2:
**  09/??/2008
*******************************/
session_start();
include('template/dbsetup.php');
?>
<?
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}
//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);
//now validating the username and password
$pre_sql = "SELECT contri4 FROM user WHERE username = '".$_SESSION['username']."'";
$pre_result=mysql_query($pre_sql);
$pre_row = mysql_fetch_row($pre_result);
$wtt;//delclare the variable "willingtotaxon"
if(mysql_num_rows($pre_result)>0){
	$wtt = $row[0];	
}else{
	//"<p>There is no match result.</p>"; //Invalid Login
}
//echo "wtt is :".$wtt;
if($wtt == '0'){
	Header("location:nowilltocontri.php");
	exit();
}

$pre_sql2 = "SELECT * FROM cc_doc WHERE ccdocowner = '".$_SESSION['username']."'";
$pre_result2=mysql_query($pre_sql2);
if(mysql_num_rows($pre_result2)>0){
}else{
	Header("location:error.php");
	exit();
}
//echo "Hello".$_POST['ccdocid'];
//echo "Hello".$_POST['totalcounter'];
//echo $_POST['update1'];
for( $i =1; $i <= $_POST['totalcounter']; $i++ ){
	$update_sql = "UPDATE cc_data SET data_desc ='".$_POST['update'.$i]."' WHERE ccdoc_id='".$_POST['ccdocid']."' AND ccmeta_id='".$_POST['updatemetaid'.$i]."'";
	//echo "update_sql :: ".$update_sql."<BR>";
	mysql_query($update_sql);
}
	Header("location:authoradmin.php");
	exit();


?>
