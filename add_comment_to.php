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
	
	
	if(isset($_POST[submit_b]) && $_POST[post_from_form] === '1'){
		//NEW Taxon Profiles Commnet TABLE::doc_comment
		//cid ref_uid ref_docid comment_type comment_detail cre_datetime
		//comment_type::0::general comment
		//comment_type::1::review opinion
		//comment_type::2::ballot (for voting)
		
		$ref_uid = htmlspecialchars($_POST['ref_uid'],ENT_QUOTES);
		$ref_docid = htmlspecialchars($_POST['ref_docid'],ENT_QUOTES);
		$comment_detail = htmlspecialchars($_POST['comment_detail'],ENT_QUOTES);
		$is_review_opinion = htmlspecialchars($_POST['is_review_opinion'],ENT_QUOTES);
		
		
		$datetime = date("Y-m-d H:i:s");//"2008-08-28 11:03:21"
		//Find maximun id number in TABLE::doc_comment
		$max_cid = 0;
		$sql_max_cid = "SELECT (Max(cid)+1) FROM doc_comment";
		$result_max_cid = mysql_query($sql_max_cid);	  
		list($max_cid) = mysql_fetch_row($result_max_cid);
		if($max_cid == 0){
			$max_cid = 1;
		}
		
		$comment_type = '0';
		if($is_review_opinion == '1'){
			$comment_type = '1';
		}
		
		//cid ref_uid ref_docid comment_type comment_detail cre_datetime
		$insert_sql = "INSERT INTO doc_comment (`cid`, `ref_uid`, `ref_docid`, `comment_type`, `comment_detail`, `cre_datetime`)";
		$insert_sql .= "VALUES ('$max_cid', '$ref_uid', '$ref_docid', '$comment_type', '$comment_detail' , '$datetime')";
		//echo "\$insert_sql is ".$insert_sql."<br>\n";
		
		
		//mysql_query($insert_sql) or die(mysql_error());
		
		
		if(mysql_query($insert_sql)){
			mysql_close($link);
			//Header("Location:add_page_success.php?page_id=".$maxid);
			Header("Location:viewdoc.php?docid=".$ref_docid);
		}else{
			$error_msg = mysql_error();
			mysql_close($link);
			//die(mysql_error());
			Header("Location:error.php");
		}
		
		
	}else{
		echo "Illegal Access!";
	}
?>