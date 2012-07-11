<?php
/******************************
**	docsubmit.php
**	elviscat@gmail.com
**  Elvis Hsin-Hui Wu
**  06/09/2009 Monday
**  version2:
**  0?/??/200? Monday?
**  version3:
**  0?/??/200? Thursday?
*******************************/
//echo "Hello2";
session_start();
require_once('../inc/config.inc.php'); // Get the config information

include('../template/dbsetup.php');
//security concern
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}
//get the posted values
$ccdocid = htmlspecialchars($_POST['ccdocid'],ENT_QUOTES);
//echo "Yes, I got your data!";

//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);
//mysql query
//因為是跟好幾個隱藏的變數，所以不用作安全性考量?(09/16/2008 18:52)

$ccdocowner = "";
$ccdoclevel = "";
$ccdoclevelname = "";
$ccdocname = "";
$sql = "SELECT ccdocowner, ccdoclevel, ccdoclevelname,ccdocname FROM cc_doc WHERE ccdocid ='".$ccdocid."'";
$result = mysql_query ($sql) or die ("Invalid query");
if(mysql_num_rows($result)>0){
	while ($nb=mysql_fetch_array($result)) {
		$ccdocowner = $nb[0];
		$ccdoclevel = $nb[1];
    $ccdoclevelname = $nb[2];
    $ccdocname = $nb[3];
	}
}

$author_uid = "";
$author_name = "";
$author_email = "";
$sql2 = "SELECT uid, name, eml FROM user WHERE username ='".$ccdocowner."'";
$result2 = mysql_query ($sql2) or die ("Invalid query");
if(mysql_num_rows($result2)>0){
	while ($nb2=mysql_fetch_array($result2)) {
		$author_uid = $nb2[0];
    $author_name = $nb2[1];
		$author_email = $nb2[2];
	}
}

//Step 1::
//Write email to administrator
//get主機位置
$serverhostname = getenv('SERVER_NAME');
$address = $_SERVER["REQUEST_URI"];
$array_address = explode("/", $address);


//check the email address is valid or not
require('../phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = "slumailrelay.slu.edu"; // SMTP servers
$mail->SMTPAuth = false; // turn on SMTP authentication
$mail->Username = ""; // SMTP username
$mail->Password = ""; // SMTP password
$mail->From = $author_email;
$mail->FromName = $author_name;
// 執行 $mail->AddAddress() 加入收件者，可以多個收件者
$mail->AddAddress($admin_email);
//$mail->AddAddress("elviscat@gmail.com","elviscat2@gmail.com"); // optional name
$mail->AddReplyTo($author_email,$author_name);
$mail->WordWrap = 50; // set word wrap
// 執行 $mail->AddAttachment() 加入附件，可以多個附件
//$mail->AddAttachment("path_to/file"); // attachment
//$mail->AddAttachment("path_to_file2", "INF");
// 電郵內容，以下為發送 HTML 格式的郵件
$mail->IsHTML(true); // send as HTML
$mail->Subject = "Account and document content submit for review from ".$author_name;
//$mail->Body = "This is the <b>HTML body</b>";
$mail->Body = "Dear Administrator,<br>";
$mail->Body .= $author_name." just submit his account and document information to you for review.<br>";
$mail->Body .= "Please go to Cypriniformes Commons system using administrator role to select the reviewers in next stage.<br>";
$mail->Body .= "Or http:://".$serverhostname."/".$array_address[1]."/".$array_address[2]."/adminviewdoc.php ,this is another link.<br>";
$mail->Body .= "With Regards,<br>";
$mail->Body .= $author_name." ".$author_email."<br>";

$mail->AltBody = "This is the text-only body";

//echo "<p>\n";
if(!$mail->Send()){
  echo "Fail!";
  //echo "Your recommendation is not sent.";
  //echo "Mailer Error: " . $mail->ErrorInfo;
  //exit;
  //echo "The administrator email address is not valid."; //Request Password Fail

}else{
  echo "Success!";
}

//Step 2::
//Change the column::ccdocstatus in table::cc_doc from initialized to under_reviewing 
$update_sql = "UPDATE cc_doc SET ccdocstatus ='under_reviewing' WHERE ccdocid='".$ccdocid."'";
//echo "update_sql :: ".$update_sql."<BR>";
mysql_query($update_sql)or die ("Invalid query for update_sql");;

//Step 3::
//Post this information to blog
//table::post
//find the maximun pid
$max_pid = 0;
$find_max_pid_sql = "SELECT MAX(pid) FROM post";
$result_find_max_pid_sql = mysql_query ($find_max_pid_sql) or die ("Invalid query");
if(mysql_num_rows($result_find_max_pid_sql)>0){
	while ($nb=mysql_fetch_array($result_find_max_pid_sql)) {
		$max_pid = $nb[0]+1;
	}
}else{
	$max_pid = 1;
}

if($ccdoclevel == "family" || $ccdoclevel == "genus"){  
  //do nothing!!
}else if($ccdoclevel == "species"){
  $species_name_sql = "SELECT mgenus FROM biglonglist WHERE mgenus = '".$ccdoclevelname."' AND mspecies = '".$ccdocname."'";
  //echo "species_name_sql is::".$species_name_sql;
  $result_species_name_sql = mysql_query ($species_name_sql) or die ("Invalid query");
  if(mysql_num_rows($result_species_name_sql)>0){
	  while ( $nb_species_name_sql = mysql_fetch_array($result_species_name_sql) ) {
		  $ccdocname = $nb_species_name_sql[0]." ".$ccdocname;
	  }
  }
}

//document content
$doc_content = "";
$doc_sql = "SELECT * FROM cc_doc WHERE ccdocid ='".$ccdocid."'";
//echo "doc_sql".$doc_sql;
$result_doc_sql = mysql_query ($doc_sql) or die ("Invalid query");
$ccdoclevel = "";
$ccdoctype = "";
if(mysql_num_rows($result_doc_sql)>0){
  while ($nb_result_doc_sql = mysql_fetch_array($result_doc_sql)) {
    $ccdoclevel = $nb_result_doc_sql[2];
	  $ccdoctype = $nb_result_doc_sql[5];
  }
	$frame_sql = "SELECT * FROM cc_meta WHERE doc_level='".$ccdoclevel."' AND doc_role ='".$ccdoctype."'";
	//echo "frame_sql is ".$frame_sql;
	$frame_result = mysql_query ($frame_sql) or die ("Invalid query frame_sql");
	if(mysql_num_rows($frame_result) > 0 ){
    while ( $nb_frame_result = mysql_fetch_array($frame_result) ) {
      $doc_content .= "<h3>".$nb_frame_result[4].":</h3>\n";
      $cc_data_sql = "SELECT * FROM cc_data WHERE ccdoc_id='".$ccdocid."' AND ccmeta_id='".$nb_frame_result[3]."'";
			//echo "cc_data_sql is :: ".$cc_data_sql."<BR>\n";
			$result_cc_data_sql = mysql_query ($cc_data_sql) or die ("Invalid query cc_data_sql");
	    if(mysql_num_rows($result_cc_data_sql) > 0 ){
			  while ( $nb_result_cc_data_sql = mysql_fetch_array($result_cc_data_sql) ) {
          $doc_content .= $nb_result_cc_data_sql[3]."<br>";
				}
      }
    }
  }

$doc_content .= "<br>Or You can go to here to see::<a href=\"http://".$serverhostname."/".$array_address[1]."/".$array_address[2]."/viewdoc.php?ccdocid=".$ccdocid."\">Detail</a><br>";

$ptitle = "New submitted information for ".$ccdocname." from ".$author_name;
$pcontent = "New information submitted!<BR>".$doc_content;
$pcredate = date("Y-m-d H:i:s");//"2008-08-28 11:03:21"
$prefuid = $author_uid;
$pcount = 0; 
$ptag = $ccdocname;
$pcategory = "Submiting new information"; 

$insert_sql = "INSERT INTO post ";
$insert_sql .= " (pid,ptitle,pcontent,pcredate,prefuid,pcount,ptag,pcategory) VALUES";
$insert_sql .= " ('$max_pid','$ptitle','$pcontent','$pcredate','$prefuid','$pcount','$ptag','$pcategory')";
//echo "insert_sql :: ".$insert_sql;
mysql_query ($insert_sql) or die ("Invalid insert query");
}


mysql_close($link);

?>