<?PHP
	session_start();
	include('template/dbsetup.php');

	if(!isset($_SESSION['is_login'])){
		Header("location:error.php");
		exit();
	}

	//connect to database
	$link = mysql_connect($host , $dbuser ,$dbpasswd); 
	if (!$link) {
   		die('Could not connect: ' . mysql_error());
	}
	//select database
	mysql_select_db($dbname);
	
	//$docid = $_GET['docid'];
	//$ccmetaid = $_GET['ccmetaid'];
	$docid = "";
	$ccmetaid = "";	
	
	$ccimg_id = $_GET['ccimg_id'];
	$sql_ccdoc_id = "SELECT * FROM cc_img WHERE ccimg_id = '".$ccimg_id."'";
	//echo "\$sql_ccdoc_id is : ".$sql_ccdoc_id."<BR />\n"; 
	$result_ccdoc_id = mysql_query ($sql_ccdoc_id) or die ("Invalid Query of ccdoc_id finding");
	if(mysql_num_rows($result_ccdoc_id) > 0 ){
		while ( $nb_ccdoc_id = mysql_fetch_array($result_ccdoc_id) ) {
			$docid = $nb_ccdoc_id['ccdoc_id'];
			$ccmetaid = $nb_ccdoc_id['ccmeta_id'];	
		}
	}

	$uid = $_SESSION['uid'];
	
	$sql_owner_check = "SELECT * FROM cc_doc WHERE docid = '".$docid."' AND ref_uid='".$uid."'";
	//echo "\$sql_owner_check is : ".$sql_owner_check."<BR />\n"; 
	$result_owner_check = mysql_query ($sql_owner_check) or die ("Invalid Query of Document Owner Check");
	
	if(mysql_num_rows($result_owner_check) > 0 ){
		//$update_sql = "UPDATE cc_img SET pic_content = '' WHERE ccdoc_id = '".$docid."' AND ccmeta_id ='".$ccmetaid."'";
		// //echo "\$update_sql is".$update_sql."<BR />\n";
		//mysql_query($update_sql);
		
		$delete_sql = "DELETE FROM cc_img WHERE ccimg_id = '".$ccimg_id."'";
		//echo "\$delete_sql is".$delete_sql."<BR />\n";
		if(mysql_query($delete_sql)){
			//Header("Location:userprofileedit.php?uid=".$uid);
			Header("Location:docedit.php?docid=".$docid);
		}else{
			echo "Fail!";
		}
	}else{
		echo "You are not the owner of this picture/photo!<BR />\n";
		echo "Back to <a href=\"docedit.php?docid=".$docid."\">Taxon Profile Document</a>\n";
	}
?>
