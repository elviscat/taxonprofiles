<?php 
//echo "Hello2";
session_start();
include('../template/dbsetup.php');
//security concern
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}
/******************************
**	accountadmin.php
**	elviscat@gmail.com
**  Elvis Wu
**  09/16/2008
**  version2:
**  05/27/2009
**  version3:
**  05/11/2012 Friday
**  version4:
**  05/12/2012 Saturday
**  version5:
**  07/02/2012 Monday
*******************************/
//get the posted values
$totalcounter = htmlspecialchars($_POST['totalcounter'],ENT_QUOTES);
$docid = htmlspecialchars($_POST['docid'],ENT_QUOTES);
$content = htmlspecialchars($_POST['content'],ENT_QUOTES);
$contentid = htmlspecialchars($_POST['contentid'],ENT_QUOTES);
//echo "TotalCounter is ".$totalcounter."  ".$content."  ".$contentid;
//echo "TotalCounter is ".$totalcounter;

//version4:05/12/2012 Saturday
$doc_title = htmlspecialchars($_POST['doc_title'],ENT_QUOTES);
$doc_content = htmlspecialchars($_POST['doc_content'],ENT_QUOTES);
//version4:05/12/2012 Saturday


//version5:07/02/2012 Monday
$doc_add_sql = stripslashes($_POST['doc_add_sql']);
//$doc_add_sql = $_POST['doc_add_sql'];
//version5:07/02/2012 Monday




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




//mysql query
//因為是跟好幾個隱藏的變數，所以不用作安全性考量?(09/16/2008 18:52)

$max_ccdata_id = 0;
$sql = "SELECT MAX(ccdata_id) FROM cc_data";
$result = mysql_query ($sql) or die ("Invalid query");
if(mysql_num_rows($result)>0){
	while ($nb=mysql_fetch_array($result)) {
		$max_ccdata_id = $nb[0]+1;
	}
}else{
	$max_ccdata_id = 1;
}

$meta_id = explode("@#", $contentid);
$content = explode("@#", $content);
//echo $meta_id[0];
for($i = 0 ; $i < sizeof($meta_id) ; $i++){
	$insert_sql = "INSERT INTO cc_data ";
	$insert_sql .= " (ccdata_id,ccdoc_id,ccmeta_id,data_desc) VALUES";
	$insert_sql .= " ('$max_ccdata_id','$docid','$meta_id[$i]','$content[$i]')";
	//echo "\$insert_sql is :: ".$insert_sql."<BR />\n";
	$max_ccdata_id++;
	mysql_query ($insert_sql) or die ("Invalid insert query :: insert sql ");
}

echo $doc_add_sql;

mysql_query ($doc_add_sql) or die ("Invalid insert query :: insert cc_doc sql ");


$update_sql = "UPDATE cc_doc SET title = '".$doc_title."', content = '".$doc_content."' WHERE docid ='".$docid."'";
//echo $update_sql;
mysql_query ($update_sql) or die ("Invalid insert query :: update cc_doc sql ");


mysql_close($link);

?>