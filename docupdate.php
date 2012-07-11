<?
/******************************
**	authoraccountupdate.php
**	elviscat@gmail.com
**  Elvis Wu
**  09/20/2008
**  version2:
**  05/15/2012 Tuesday
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
$is_data_existing = False;

for( $i =1; $i <= $_POST['totalcounter']; $i++ ){
	
	$sql_data_existing_checking = "SELECT * FROM cc_data WHERE ccdoc_id ='".$_POST['docid']."' AND ccmeta_id = '".$_POST['updatemetaid'.$i]."'";
	$result_data_existing_checking = mysql_query($sql_data_existing_checking);
	if(mysql_num_rows($result_data_existing_checking) > 0){
		while($nb_data_existing_checking = mysql_fetch_array($result_data_existing_checking)){
			if($nb_data_existing_checking['data_desc'] != ""){
				$is_data_existing = True;
			}
		}
	}
	
	$data_desc = $_POST['update'.$i];
	$docid = $_POST['docid'];
	$ccmeta_id = $_POST['updatemetaid'.$i];
	if($is_data_existing ==  True){
		$update_sql = "UPDATE cc_data SET data_desc ='".$data_desc."' WHERE ccdoc_id='".$docid."' AND ccmeta_id='".$ccmeta_id."'";
		//echo "\$update_sql :: ".$update_sql."<BR />\n";
		mysql_query($update_sql);
	}else{
		$insert_sql = "INSERT INTO cc_data (`ccdoc_id`,`ccmeta_id`,`data_desc`) VALUES ('$docid','$ccmeta_id','$data_desc')";
		//echo "\$insert_sql :: ".$insert_sql."<BR />\n";
		mysql_query($insert_sql);
	}
	
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
