<?php 
session_start();
include('../template/dbsetup.php');
include('../inc/config.inc.php');
//Developed by elviscat

//get the posted values
$username=htmlspecialchars($_POST['username'],ENT_QUOTES);
$password=htmlspecialchars($_POST['password'],ENT_QUOTES);
$passwordagain=htmlspecialchars($_POST['passwordagain'],ENT_QUOTES);
$eml=htmlspecialchars($_POST['eml'],ENT_QUOTES);
$emlagain=htmlspecialchars($_POST['emlagain'],ENT_QUOTES);

//echo $username."+".$password."+".$passwordagain."+".$eml."+".$emlagain;

//check for admin
if(strlen($username)<6 || strlen($username)>20 || strlen($password)<6 || strlen($password)>20){
	echo "your username or password does not follow the rule";
}else if(strcmp($password,$passwordagain)!=0){
	echo "password does not match";
}elseif(strcmp($eml,$emlagain)!=0){
	echo "email does not match";
}else{
	//Connect to database
	$link = mysql_connect($host , $dbuser ,$dbpasswd); 
	if (!$link) {
    	die('Could not connect: ' . mysql_error());
	}
	//echo "This ia a test!";
	//select database
	mysql_select_db($dbname);
	//now check that if the username is duplicated or not
	$sql="SELECT username FROM user WHERE username='".$username."'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	//if username exists
	if(mysql_num_rows($result)>0){
		//return the duplicate message to say that
		echo "Duplicate user, you need register with another login name!";
	    //...
	}else{
		$activationkey = mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();
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
		$mail->From = "cypriniformes@gmail.com";
		$mail->FromName = "Taxon Profiles Admin";
		// 執行 $mail->AddAddress() 加入收件者，可以多個收件者
		$mail->AddAddress($eml,$username);
		//$mail->AddAddress("elviscat@gmail.com"); // optional name
		$mail->AddReplyTo("cypriniformes@gmail.com","Taxon Profiles Admin");
		$mail->WordWrap = 50; // set word wrap
		// 執行 $mail->AddAttachment() 加入附件，可以多個附件
		//$mail->AddAttachment("path_to/file"); // attachment
		//$mail->AddAttachment("path_to_file2", "INF");
		// 電郵內容，以下為發送 HTML 格式的郵件
		$mail->IsHTML(true); // send as HTML
		$mail->Subject = "Thanks for Register for Taxon Profiles";
		//$mail->Body = "This is the <b>HTML body</b>";
		$mail->Body = "Hi ".$username.",<BR /><BR />";
		$mail->Body .= "Thanks for Registering for Taxon Profiles. In order to complete your registration, please";
		//$mail->Body .= " <a href=\"http://".$serverhostname."/~wgcadmin/cypcom/registerconfirm.php?username=".$username."&eml=".$eml."\" >";
		$mail->Body .= "click <a href=\"".HomePWDURL(2)."registerconfirm.php?username=".$username."&eml=".$eml."&actkey=".$activationkey."\" >";
		$mail->Body .= "here</a> to confirm your email address, or <font color=\"blue\">cut</font> ";
		$mail->Body .= "and <font color=\"blue\">paste</font> the below address in to your browser:<BR>";
		//$mail->Body .= "<a href=\"http://".$serverhostname."/~wgcadmin/cypcom/registerconfirm.php?username=".$username."&eml=".$eml."\" >http://".$serverhostname."/~wgcadmin/cypcom/registerconfirm.php?username=".$username."&eml=".$eml."</a>";
		$mail->Body .= "<a href=\"".HomePWDURL(2)."registerconfirm.php?username=".$username."&eml=".$eml."&actkey=".$activationkey."\" >".HomePWDURL(2)."registerconfirm.php?username=".$username."&eml=".$eml."&actkey=".$activationkey."</a>";
		$mail->Body .= "<BR>";
		$mail->Body .= "Best Regards,<BR>";
		$mail->Body .= "Taxon Profiles Admin";

		$mail->AltBody = "This is the text-only body";
		if(!$mail->Send()){
			//echo "Message was not sent <p>";
			//echo "Mailer Error: " . $mail->ErrorInfo;
			//exit;
			echo "This email address is not valid"; //Request Password Fail
		}else{
			//echo "Message has been sent";
			echo "register success";
			//wirte these information into database
			$sql2 = "SELECT (Max(uid)+1) FROM user";
		    $result2=mysql_query($sql2);
	    	list($maxuid) = mysql_fetch_row($result2);
			if($maxuid == 0){
				$maxuid = 1;
			}
			//echo $nT;
			/*
			$rs2 =mysql_query("INSERT INTO user (uid,username,passwd,firstname,lastname,eml,contactphone,
				inst,interest,edulevel,spec,pwdhint,pwdans,actlevel,role,will)
    		VALUES ('$nT', '$_SESSION[username]', '$_SESSION[password]', '$_SESSION[firstname]',
    			'$_SESSION[lastname]', '$_SESSION[eml]', '$_SESSION[contactphone]', '$_SESSION[insti]',
    			'$_SESSION[interest]', '$_SESSION[edulev]', '$_SESSION[spec]', '$_SESSION[pwdhint]',
    			'$_SESSION[pwdans]', 'no', 'user', $_SESSION[willing])"
    		);
			echo $rs2;
			*/
			$regtime = date("Y-m-d H:i:s");//"2008-08-28 11:03:21"
			$sql3="INSERT INTO user (uid,username,passwd,eml,actlevel,activationkey, regtime)
    			VALUES ('$maxuid','$username','$password','$eml','0','$activationkey','$regtime')";
			//echo $sql3;
			mysql_query($sql3);
			//mysql connection close
		}			
	}
	mysql_close($link);
}
?>