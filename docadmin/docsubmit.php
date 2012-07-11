<?php
/******************************
**	docsubmit.php
**	elviscat@gmail.com
**  Elvis Hsin-Hui Wu
**  06/09/2009 Monday
**  version2:
**  07/03/2012 Tuesday
**  version3:
**  0?/??/200? ???????
*******************************/
session_start();
require_once('../inc/config.inc.php'); // Get the config information

include('../template/dbsetup.php');

//Access control
if(!isset($_SESSION['is_login'])){
	Header("location:error.php?msg=Not Login");
	exit();
}

//get the post values
$docid = htmlspecialchars($_POST['docid'],ENT_QUOTES);
$submit_from_form = htmlspecialchars($_POST['submit_from_form'],ENT_QUOTES);


//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);
//mysql query


//因為是跟好幾個隱藏的變數，所以不用作安全性考量?(09/16/2008 18:52)

$ref_uid;
$sql_ref_uid = "SELECT * FROM cc_doc WHERE docid ='".$docid."'";
$result_ref_uid = mysql_query ($sql_ref_uid) or die ("Invalid query:: \$sql_ref_uid");
if(mysql_num_rows($result_ref_uid)>0){
	while ($nb_ref_uid = mysql_fetch_array($result_ref_uid)) {
		$ref_uid = $nb_ref_uid['ref_uid'];
	}
}


$user_eml;
$user_name;

$sql_user = "SELECT * FROM user WHERE uid ='".$ref_uid."'";
$result_user = mysql_query ($sql_user) or die ("Invalid query:: \$sql_user");
if(mysql_num_rows($result_user)>0){
	while ($nb_user = mysql_fetch_array($result_user)) {
		$user_name = $nb_user['name'];
        $user_eml = $nb_user['eml'];
	}
}

//Step 1::
//Send email to notify administrator about this new post


//check the email address is valid or not
require('../phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = "slumailrelay.slu.edu"; // SMTP servers
$mail->SMTPAuth = false; // turn on SMTP authentication
$mail->Username = ""; // SMTP username
$mail->Password = ""; // SMTP password
$mail->From = $user_eml;
$mail->FromName = $user_name;
// 執行 $mail->AddAddress() 加入收件者，可以多個收件者
$mail->AddAddress($admin_email);
//$mail->AddAddress("elviscat@gmail.com","elviscat2@gmail.com"); // optional name
$mail->AddReplyTo($user_eml,$user_name);
$mail->WordWrap = 50; // set word wrap
// 執行 $mail->AddAttachment() 加入附件，可以多個附件
//$mail->AddAttachment("path_to/file"); // attachment
//$mail->AddAttachment("path_to_file2", "INF");
// 電郵內容，以下為發送 HTML 格式的郵件
$mail->IsHTML(true); // send as HTML
$mail->Subject = $user_name." has submitted this document for reviewing";
//$mail->Body = "This is the <b>HTML body</b>";
$mail->Body = "Hi Administrator,<br>";
$mail->Body .= $user_name." has just submitted this <a href=\"".HomePWDURL(2)."viewdoc.php?docid=".$docid."\">document</a> to you for reviewing.<br>";
$mail->Body .= "Please go to <a href=\"".HomePWDURL(2)."\">Taxon Profiles</a> to check.<br>";
$mail->Body .= "With Regards,<br>";
$mail->Body .= $user_name." (".$user_eml.")<br>";

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
//Change the column::state in TABLE::cc_doc from -1 ("Author self upload ...") to 0 ("Submitted, Under Review ...")
$sql_update = "UPDATE cc_doc SET state ='0' WHERE docid='".$docid."' AND state = '-1'";
//echo "\$sql_update is :: ".$sql_update."<BR>";
mysql_query($sql_update)or die ("Invalid query:: \$sql_update");;


mysql_close($link);

?>