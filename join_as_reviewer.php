<?php
	//Access control by login status
	session_start();
	if( isset($_SESSION['is_login']) && !empty($_SESSION['is_login']) && $_SESSION['is_login'] == True ){
		//
		//echo 'Log in status';
	}else{
		//echo 'Log out status';
		Header("location:error.php");
		exit();
	}
	
	include('template/dbsetup.php');
	require('inc/config.inc.php');
	

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
	
	
	$doc_reviewer = '';
	$new_doc_reviewer = '';
	
	$usr_review_doc = '';
	$new_usr_review_doc = '';
	
	$msg = '';
	
	
	if($_GET[docid] != '0'){
		$sql_reviewer = "SELECT * FROM cc_doc WHERE docid = '".$_GET['docid']."'";
		//echo "\$sql_reviewer is : ".$sql_reviewer."<BR />\n"; 
		$result_reviewer = mysql_query ($sql_reviewer) or die ("Invalid query frame_sql");
		if(mysql_num_rows($result_reviewer) > 0 ){
			while ( $nb_reviewer = mysql_fetch_array($result_reviewer) ) {
				$doc_reviewer = $nb_reviewer['reviewer'];
			}
		}
		
		$sql_usr_review_doc = "SELECT * FROM user WHERE uid = '".$_SESSION['uid']."'";
		//echo "\$sql_usr_review_doc is : ".$sql_usr_review_doc."<BR />\n"; 
		$result_usr_review_doc = mysql_query ($sql_usr_review_doc) or die ("Invalid query frame_sql");
		if(mysql_num_rows($result_usr_review_doc) > 0 ){
			while ( $nb_usr_review_doc = mysql_fetch_array($result_usr_review_doc) ) {
				$usr_review_doc = $nb_usr_review_doc['review_doc'];
			}
		}
		
		
		$is_reviewer = False;
		if($doc_reviewer != ""){
			$doc_reviewer_array = explode(';', $doc_reviewer);
			for($i = 0; $i < sizeof($doc_reviewer_array); $i++){
				//echo $doc_reviewer_array[$i]." == ".$_SESSION['uid']."<BR />\n";
				if($doc_reviewer_array[$i] == $_SESSION['uid']){
					$is_reviewer = True;
				}
			}
		}
		if($is_reviewer == True){
			$msg = "Your are already the reviewer for this document!<BR />\n";
		}else{
			//echo "\$doc_reviewer is :: ".$doc_reviewer."<BR />\n";
			if($doc_reviewer != ''){
				$new_doc_reviewer = $doc_reviewer.";".$_SESSION['uid'];
			}else{
				$new_doc_reviewer = $_SESSION['uid'];
			}
			//echo "\$new_doc_reviewer is :: ".$new_doc_reviewer."<BR />\n";
			$update_sql = "UPDATE cc_doc SET reviewer ='".$new_doc_reviewer."' WHERE docid='".$_GET['docid']."'";
			//echo "\$update_sql is :: ".$update_sql."<BR />\n";
			
			
			//echo "\$usr_doc_reviewer is :: ".$usr_doc_reviewer."<BR />\n";
			if($usr_review_doc != ''){
				$new_usr_review_doc = $usr_review_doc.";".$_GET['docid'];
			}else{
				$new_usr_review_doc = $_GET['docid'];
			}
			//echo "\$new_usr_doc_reviewer is :: ".$new_usr_doc_reviewer."<BR />\n";
			$update_sql_2 = "UPDATE user SET review_doc ='".$new_usr_review_doc."' WHERE uid='".$_SESSION['uid']."'";
			//echo "\$update_sql_2 is :: ".$update_sql_2."<BR />\n";

			
			if(mysql_query($update_sql) && mysql_query($update_sql_2)){
				$msg = "Thanks, you have joined into successfully!\n";
			}else{
				$msg = "Join Fail!<BR />\n";
			}
		}
		
	}else{
		$msg = "Illegal Access!";
	}
	Header("Location: join_as_reviewer2.php?docid=".$_GET['docid']."&msg=".$msg)
?>