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

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


/*
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
*/

$pre_sql2 = "SELECT * FROM cc_doc WHERE ref_uid = '".$_SESSION['uid']."'";
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
	$update_sql = "UPDATE cc_data SET data_desc ='".$_POST['update'.$i]."' WHERE ccdoc_id='".$_POST['docid']."' AND ccmeta_id='".$_POST['updatemetaid'.$i]."'";
	//echo "update_sql :: ".$update_sql."<BR>";
	mysql_query($update_sql);
}

$docid = $_POST['docid'];
$doc_title = $_POST['doc_title'];
$doc_content = $_POST['doc_content'];
$update_cc_doc_sql = "UPDATE cc_doc SET title ='".$doc_title."', content ='".$doc_content."' WHERE docid ='".$docid."'";
//echo $update_cc_doc_sql;
mysql_query($update_cc_doc_sql);
	
	Header("location:docedit.php?docid=".$_POST['docid']);
	//Header("location:useradmin.php");
	exit();


?>
