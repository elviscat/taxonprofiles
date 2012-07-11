<?
/******************************
**	docdecision.php::
**	elviscat@gmail.com
**  Elvis Hsin-Hui Wu
**  06/10/2009 Wednesday
**  version2:
**  05/12/2012 Saturday
**  version3:
**  0?/??/200? Thursday?
*******************************/
session_start();
include('template/dbsetup.php');
include('inc/config.inc.php');
?>
<?
if(!isset($_SESSION['is_login'])){
	//Header("location:error.php");
	echo "Illegal Access:: You don't log in!";
	exit();
}
if(!isset($_SESSION['role']) == "admin"){
	//Header("location:error.php");
	echo "Illegal Access:: You are not admin!";
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

	if( $_GET['docid'] != '' && $_GET['action'] != ''){
		$doc_state = '';
		
		$sql_doc_state_check = "SELECT * FROM cc_doc WHERE docid='".$_GET['docid']."'";
		//echo "\$sql_doc_state_check is ::".$sql_doc_state_check."<BR />\n";
		$result_doc_state_check = mysql_query ($sql_doc_state_check) or die ("Invalid query");
		if(mysql_num_rows($result_doc_state_check) > 0){
			while ( $nb_doc_state_check = mysql_fetch_array($result_doc_state_check) ) {
				$doc_state = $nb_doc_state_check['state'];
			}
		}
		if($doc_state == '0'){
			$decision = '';
			if($_GET['action'] == "approve"){
				$decision = '2';
			}else if ($_GET['action'] == "disapprove"){
				$decision = '1';
			}else{
				
			}
			//echo "\$decision is :: ".$decision."<BR />\n";
			
			//do the decision since this document is still nuder open discussion
			$update_sql = "UPDATE cc_doc SET decision = '".$decision."' WHERE docid = '".$_GET['docid']."'";
			$update_sql_2 = "UPDATE cc_doc SET state = '1' WHERE docid = '".$_GET['docid']."'";
			if(mysql_query($update_sql) && mysql_query($update_sql_2)){
				mysql_close($link);
				Header("Location:reviewpanel.php");
			}else{
				$error_msg = mysql_error();
				mysql_close($link);
				//die(mysql_error());
				//Header("Location:add_page_fail.php?error_msg=".$error_msg);
				echo $error_msg;
				exit();
			}
		}else{
			echo "The decision of this document is made and the discussion is also closed!";
			exit();
		}
	}else{
		echo "Illegal Access!";
		exit();
	}



?>
