<?
session_start();
include('template/dbsetup.php');
//echo "HELLO!!";
/*
echo $_SESSION['username'];
echo "<br>";
echo $_SESSION['role'];
echo "<br>";
echo $_SESSION['is_login'];
echo "<br>";
*/
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}

if($_SESSION['username'] == 'admin' && $_SESSION['role'] == 'admin'){
	Header("location:admin_dashboard.php");
  	//Header("location:../admin/admin.php");
	exit();
}else{
	//Connect to database
	$link = mysql_connect($host , $dbuser ,$dbpasswd);
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($dbname);
	$sql="SELECT * FROM user WHERE username ='".$_SESSION['username']."'";
	//echo $sql;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0){
		//check the actlevel
		$row = mysql_fetch_array($result);
		//echo $row;
		//echo $row['actlevel'];
		if($row['actlevel']==0){
			Header("location:notactivated.php");
			//okay
			exit();		
		}else if($row['actlevel']==1){
			Header("location:user_dashboard.php");
			//
			exit();		
		}else{
			Header("location:error.php");
			exit();		
		}		
		/*
		if($row['actlevel']==0){
			Header("location:notactivated.php");
			//okay
			exit();		
		}else if($row['actlevel']==1){
			Header("location:presurvey.php");
			//
			exit();		
		}else if($row['actlevel']==2){
			Header("location:admin.php");
			exit();		
		}else{
			Header("location:error.php");
			exit();		
		}
		*/		
	}else{
		Header("location:error.php");
		exit();		
	}
	//mysql connection close
	mysql_close($link);
}
?>


