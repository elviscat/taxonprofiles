<?php 
session_start();
include('../template/dbsetup.php');
//Developed by elviscat

//get the posted values
$user_name=htmlspecialchars($_POST['user_name'],ENT_QUOTES);
$pass=htmlspecialchars($_POST['eml'],ENT_QUOTES);

//echo $user_name."+".$pass;
//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
//echo "Hello1";
//select database
mysql_select_db($dbname);
//now validating the username and password
$sql="SELECT username, eml, passwd FROM user WHERE username='".$user_name."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
//if username exists
if(mysql_num_rows($result)>0){
		//compare the user_name and eml
		if(strcmp($row['eml'],$pass)==0){
			//echo "request password success";
			//send mail to the eml
			//
			//
			//
			//
			//
			//
// 建立 PHPMailer 物件及設定 SMTP 登入資訊
require('../phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = "slumailrelay.slu.edu"; // SMTP servers
$mail->SMTPAuth = false; // turn on SMTP authentication
$mail->Username = ""; // SMTP username
$mail->Password = ""; // SMTP password
$mail->From = "cypriniformes@gmail.com";
$mail->FromName = "Taxon Profiles Admin";
// 執行 $mail->AddAddress() 加入收件者，可以多個收件者
$mail->AddAddress($row['eml'],$row['username']);
 //$mail->AddAddress("elviscat@gmail.com"); // optional name
$mail->AddReplyTo("cypriniformes@gmail.com","Taxon Profiles Admin");
 $mail->WordWrap = 50; // set word wrap
// 執行 $mail->AddAttachment() 加入附件，可以多個附件
//$mail->AddAttachment("path_to/file"); // attachment
//$mail->AddAttachment("path_to_file2", "INF");
// 電郵內容，以下為發送 HTML 格式的郵件
$mail->IsHTML(true); // send as HTML
$mail->Subject = "Request Your Taxon Profiles Account Password";
//$mail->Body = "This is the <b>HTML body</b>";
$mail->Body = "Hi ".$row['username'].",<BR /><BR />";
$mail->Body .= "Your Password is here: <B>".$row['passwd']."</B>.<BR /><BR />";
$mail->Body .= "<BR>";
$mail->Body .= "Best Regards,<BR>";
$mail->Body .= "Taxon Profiles Admin";

$mail->AltBody = "This is the text-only body";
if(!$mail->Send()){
	//echo "Message was not sent <p>";
	//echo "Mailer Error: " . $mail->ErrorInfo;
	//exit;
	echo "request password fail"; //Request Password Fail
}else{
	//echo "Message has been sent";
	echo "request password success";
}	
			//
			//
			//
			//
			//
			//
			//
			//
			
		}else{
			echo "request password fail"; //Request Password Fail
		}
}else{
	echo "request password fail"; //Request Password Fail
}
?>