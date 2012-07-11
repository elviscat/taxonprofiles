<?php 
/******************************
**	robot.php
**	elviscat@gmail.com
**  Elvis Hsin-Hui Wu
**  06/03/2009 Wednesday
**  version2:
**  ??/??/200? Wednesday?
**  version3:
**  ??/??/200? Wednesday?
*******************************/
// ./是這一層目錄
// ../是上一層目錄
session_start();

require_once('../inc/config.inc.php'); // Get the config information

include('../template/dbsetup.php');

//$queryString = htmlspecialchars($_POST['queryString'],ENT_QUOTES);
//$queryString = urldecode($_POST['queryString']);
$queryString = urldecode(htmlspecialchars($_POST['queryString'],ENT_QUOTES));
//echo "queryString is ::".$queryString."\n<BR>";
//%0A
//%40
//+
$queryString = str_replace('%0A', "\n", $queryString);
$queryString = str_replace('%40', "@", $queryString);
$queryString = str_replace('+', " ", $queryString);


$queryStringArray = explode("&amp;", $queryString);
//$queryStringArray = explode("&", $queryString);

$report_testing;
$page_name;
$name;

for ($i =0 ; $i < sizeof($queryStringArray); $i++){
  //echo "queryStringArray[".$i."] is ".utf8_encode($queryStringArray[$i])."<br />\n";
  
  $queryStringArray2 = explode("=", $queryStringArray[$i]);
  if($queryStringArray2[0] == 'name'){
    //$tmp_be_replaced = $queryStringArray2[0];
    //$report_testing = str_replace($tmp_be_replaced, '', $queryStringArray[$i]);
    $name = $queryStringArray2[1];
    //echo $name;
  }
  if($queryStringArray2[0] == 'report_testing'){
    //$tmp_be_replaced = $queryStringArray2[0];
    //$report_testing = str_replace($tmp_be_replaced, '', $queryStringArray[$i]);
    $report_testing = $queryStringArray2[1];
  }
  if($queryStringArray2[0] == 'page_name'){
	//$page_name = $queryStringArray2[1];
	$tmp_be_replaced = $queryStringArray2[0];
	$page_name = str_replace($tmp_be_replaced."=", '', $queryStringArray[$i]);
  }
  
}
//echo "Your name is ::".$name."\n<br>";
//echo "Your comment is ::".$comment."\n<br>";

//echo "\$report_testing is :: ".$report_testing."<BR />\n";

//echo "HomePWDURL - 0 :: ".HomePWDURL(2)."<BR />\n";
//echo "\$page_name is :: ".$page_name."<BR />\n";

//echo "Address is :: ".HomePWDURL(2).$page_name."<BR />\n";


$eml = '';

if($_SSESSION['name'] != ""){
	$name = $_SESSION['name'];
	$eml = $_SESSION['eml'];
}else if($name == ''){
	$name = "Unkonwn Name";
}else if($eml == ''){
	$eml = "elviscat@gmail.com";
}

//echo "\$name is :: ".$name."<BR />\n";
//echo "\$eml is :: ".$eml."<BR />\n";

//Write email to administrator
//get主機位置
$serverhostname = getenv('SERVER_NAME');
//check the email address is valid or not
require('../phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = "slumailrelay.slu.edu"; // SMTP servers
$mail->SMTPAuth = false; // turn on SMTP authentication
$mail->Username = ""; // SMTP username
$mail->Password = ""; // SMTP password
//$mail->From = "elviscat@gmail.com";
$mail->From = $eml;
$mail->FromName = $name;
// 執行 $mail->AddAddress() 加入收件者，可以多個收件者
$mail->AddAddress("elviscat@gmail.com");
//$mail->AddAddress("elviscat@gmail.com","elviscat2@gmail.com"); // optional name
$mail->AddReplyTo($eml,$name);
$mail->WordWrap = 50; // set word wrap
// 執行 $mail->AddAttachment() 加入附件，可以多個附件
//$mail->AddAttachment("path_to/file"); // attachment
//$mail->AddAttachment("path_to_file2", "INF");
// 電郵內容，以下為發送 HTML 格式的郵件
$mail->IsHTML(true); // send as HTML
$mail->Subject = "Report Testing from ".$name;
//$mail->Body = "This is the <b>HTML body</b>";
//$mail->Body = "Dear Administrator,<br>";
//$mail->Body .= "I am ".$name.".<br>";
//$mail->Body .= "My comment is ".$comment.".<br>";
//$mail->Body .= "My email is ".$eml.".<br>";
//$mail->Body .= "Please reply this email ".$eml." to me.<br>";
//$mail->Body .= "With Regards,<br>";
//$mail->Body .= $name;
$mail->Body = "Address :: ".HomePWDURL(2).$page_name."<BR />";
$mail->Body .= "Report :: ".$report_testing;

$mail->AltBody = "This is the text-only body";
echo "<p>\n";

if(!$mail->Send()){
  echo "Your recommendation is not sent.";
  //echo "Mailer Error: " . $mail->ErrorInfo;
  //exit;
  echo "The administrator email address is not valid."; //Request Password Fail
}else{
  echo "Your testing report has been sent.";
}
echo "</p>\n";
?>
