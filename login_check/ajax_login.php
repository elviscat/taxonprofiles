<?php 
session_start();

require_once('../inc/config.inc.php'); // Get the config information
//include('../inc/config.inc.php'); // Get the config information

include('../template/dbsetup.php');

/***/
/*
Very Important!!
Prohibit the anyonous login???
*/
if(!isset($_POST['user_name'])){
	Header("location:error.php");
	exit();
}
/***/


//Developed by elviscat

//get the posted values
$user_name = htmlspecialchars($_POST['user_name'],ENT_QUOTES);
$pass = md5($_POST['password']);

//echo $user_name."+".$pass;


//check for admin
//if(strcmp($user_name,"admin")==0 && strcmp($pass,md5('xu3r85'))==0){
if(strcmp($user_name,"admin")==0 && strcmp($pass,md5($admin_password))==0){
	echo "admin login success";
	//now set the session from here if needed
	$_SESSION['username'] = $user_name;
	$_SESSION['name'] = "Administrator";
	$_SESSION['role'] = "admin";
	$_SESSION['is_login'] = true;
	$_SESSION['uid'] = 0;//set up the reference idnetification number, the firsr application is for blog system (blog engine).
			
}else{
	//Connect to database
	$link = mysql_connect($host , $dbuser ,$dbpasswd); 
	if (!$link) {
    	die('Could not connect: ' . mysql_error());
	}
	//echo "Hello1";
	//select database
	mysql_select_db($dbname);

	//now validating the username and password
	$sql = "SELECT uid, username, passwd, name FROM user WHERE username='".$user_name."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	//if username exists
	if( mysql_num_rows($result) > 0){
		//compare the user_name and password
		if( strcmp(md5($row['passwd']),$pass ) == 0){
			
			//now set the session from here if needed
			
			$_SESSION['username'] = $user_name;
			$_SESSION['role'] = "user"; 
			$_SESSION['is_login'] = true;
			$_SESSION['uid'] = $row['uid'];
			$_SESSION['name'] = $row['name'];
      //
			//
			//insert the login username, time, login/logout state into table:history
			$maxuid;//declare the variable "$maxuid"
			$sql2 = "SELECT (Max(uid)+1) FROM userloghis";
		    $result2=mysql_query($sql2);
	    	list($maxuid) = mysql_fetch_row($result2);
			if($maxuid == 0){
				$maxuid = 1;
			}
			$logtime = date("Y-m-d H:i:s");//"2008-08-28 11:03:21"
			$username = $user_name;
			$sql3="INSERT INTO userloghis (uid,username,logtime,state)
    			VALUES ('$maxuid','$username','$logtime','login')";
			mysql_query($sql3);			
			
			echo "user login success";
			
		}else{
			echo "password error";
		}
	}else{
		echo "invalid login"; //Invalid Login
	}
}
?>