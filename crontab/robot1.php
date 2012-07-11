#!/usr/bin/php -q
<?php

//echo "Hello Elvis!\n";
//include('template/dbsetup.php');

/******************************
**	robot1.php::
**	elviscat@gmail.com
**  Elvis Hsin-Hui Wu
**  06/10/2009 Wednesday
**  version2:
**  06/11/2009 Thursday
**  version3:
**  0?/??/200? Thursday?
*******************************/
// ./是這一層目錄
// ../是上一層目錄

session_start();
require_once('inc/config.inc.php'); // Get the config information

include('template/dbsetup.php');

require('phpmailer/class.phpmailer.php');

//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);

$sql_1 = "SELECT distinct(ccdocowner) FROM cc_doc WHERE ccdoctype ='author'";
//echo "sql_1 is ::".$sql_1."\n";
$result_sql_1 = mysql_query ($sql_1) or die ("Invalid query for sql_1");
if(mysql_num_rows($result_sql_1)>0){
  while ($nb_result_sql_1 = mysql_fetch_array($result_sql_1)) {
    //echo $nb_result_sql_1[0]."\n";
    $sql_2 = "SELECT username, name, eml FROM user WHERE username ='".$nb_result_sql_1[0]."'";
    //echo "sql_2 is ::".$sql_2."\n";
    $result_sql_2 = mysql_query ($sql_2) or die ("Invalid query for sql_2");
    if(mysql_num_rows($result_sql_2)>0){
      while ($nb_result_sql_2 = mysql_fetch_array($result_sql_2)) {
        //email to user informing his/her current status
        $username = $nb_result_sql_2[0];
        $name = $nb_result_sql_2[1];
        $eml = $nb_result_sql_2[2];
        $eml_content = "Document Detail::<br>";
        
        $sql_3 = "SELECT * FROM cc_doc WHERE ccdoctype ='author' AND ccdocowner='".$username."'";
        //echo "sql_3 is ::".$sql_3."\n";
        $result_sql_3 = mysql_query ($sql_3) or die ("Invalid query for sql_3");
        if(mysql_num_rows($result_sql_3)>0){
          while ($nb_result_sql_3 = mysql_fetch_array($result_sql_3)) {        
            $eml_content .= $nb_result_sql_3[0]." ".$nb_result_sql_3[1]." ".$nb_result_sql_3[2]." ".$nb_result_sql_3[3]." ".$nb_result_sql_3[4]." ";
            $eml_content .= $nb_result_sql_3[5]." ".$nb_result_sql_3[6]." ".$nb_result_sql_3[7]." ".$nb_result_sql_3[8]." ".$nb_result_sql_3[9]."<br>";
          }
        }

$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = "slumailrelay.slu.edu"; // SMTP servers
$mail->SMTPAuth = false; // turn on SMTP authentication
$mail->Username = ""; // SMTP username
$mail->Password = ""; // SMTP password
$mail->From = $admin_email;
$mail->FromName = "Cypriniformes Commons System Administrator";
// 執行 $mail->AddAddress() 加入收件者，可以多個收件者
$mail->AddAddress($eml);
//$mail->AddAddress("elviscat@gmail.com","elviscat2@gmail.com"); // optional name
$mail->AddReplyTo($admin_email,"Cypriniformes Commons System Administrator");
$mail->WordWrap = 50; // set word wrap
// 執行 $mail->AddAttachment() 加入附件，可以多個附件
//$mail->AddAttachment("path_to/file"); // attachment
//$mail->AddAttachment("path_to_file2", "INF");
// 電郵內容，以下為發送 HTML 格式的郵件
$mail->IsHTML(true); // send as HTML
$mail->Subject = "Your Cypriniformes Commons Account and Document Statistic informing at ".date('l jS \of F Y h:i:s A')."<br>";
//$mail->Body = "This is the <b>HTML body</b>";
$mail->Body = $eml_content;
$mail->Body .= "<br> at ".date('l jS \of F Y h:i:s A')."<br>";
$mail->Body .= "Thanks!<br>";
$mail->Body .= "Cypriniformes Commons System Administrator";
$mail->AltBody = "This is the text-only body";
if(!$mail->Send()){
  //echo "Your recommendation is not sent.";
  echo "Mailer Error: " . $mail->ErrorInfo;
  exit;
}else{
  //echo "Your recommendation has been sent.";
}
        
        
        
        
        
        
        
      }
    }
  }
}


/*

//Write email to administrator
//get????
$serverhostname = getenv('SERVER_NAME');
//check the email address is valid or not

$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = "slumailrelay.slu.edu"; // SMTP servers
$mail->SMTPAuth = false; // turn on SMTP authentication
$mail->Username = ""; // SMTP username
$mail->Password = ""; // SMTP password
$mail->From = "test@aa.com";
$mail->FromName = "Test1";
// ?? $mail->AddAddress() ?????,???????
$mail->AddAddress("hwu5@slu.edu");
//$mail->AddAddress("elviscat@gmail.com","elviscat2@gmail.com"); // optional name
$mail->AddReplyTo("test@aa.com","Test1");
$mail->WordWrap = 50; // set word wrap
// ?? $mail->AddAttachment() ????,??????
//$mail->AddAttachment("path_to/file"); // attachment
//$mail->AddAttachment("path_to_file2", "INF");
// ????,????? HTML ?????
$mail->IsHTML(true); // send as HTML
$mail->Subject = "This is a test at ".date('l jS \of F Y h:i:s A')."<br>";
//$mail->Body = "This is the <b>HTML body</b>";
$mail->Body = "This is a crontab in php test at ".date('l jS \of F Y h:i:s A')."<br>";
$mail->Body .= "Thanks!<br>";
$mail->AltBody = "This is the text-only body";
if(!$mail->Send()){
  //echo "Your recommendation is not sent.";
  echo "Mailer Error: " . $mail->ErrorInfo;
  exit;
}else{
  //echo "Your recommendation has been sent.";
}

*/


?>
