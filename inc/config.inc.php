<?php
/******************************
**	config.inc.php
**	elviscat@gmail.com
**  Elvis Hsin-Hui Wu
**  06/04/2009 Thursday
**  version2:
**  ??/??/200? Wednesday?
**  version3:
**  ??/??/200? Wednesday?
*******************************/
// ./??????
// ../??????

$admin_login_name = "admin";
$admin_password = "shiner1";
//$admin_email = "cypriniformes@gmail.com";
$admin_email = "hwu5@slu.edu";



function HomePWDURL($back_level){
	//echo "SERVER_NAME".$_SERVER['SERVER_NAME']."<br>\n";//maydenlab.slu.edu
	//echo "PHP_SELF".$_SERVER['PHP_SELF']."<br>\n";///~hwu5/fishanatomy/view.php
	//echo "REQUEST_URI".$_SERVER['REQUEST_URI']."<br>\n";///~hwu5/fishanatomy/view.php?taxon_id=1	$HomePWDURL = '';
	$HomePWDURL .= 'http';
	if ($_SERVER["HTTPS"] == 'on'){
		$HomePWDURL .= 's';
	}
	$HomePWDURL .= "://";
	if ($_SERVER["SERVER_PORT"] != '80') {
		$HomePWDURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
	} else {
		$HomePWDURL .= $_SERVER["SERVER_NAME"];
	}
	$request_uri_array = explode('/', $_SERVER["REQUEST_URI"]);
	for($i = 0; $i < (sizeof($request_uri_array)-$back_level); $i++){
		$HomePWDURL .= $request_uri_array[$i]."/";
	}
	return $HomePWDURL;
}

function user_name($index, $id_column_name, $user_name_column_index, $table_name){
	$user_name = "";
	$sql = "SELECT * FROM ".$table_name." WHERE ".$id_column_name." ='".$index."'";
	//echo $sql."<BR />\n";
	$result_sql = mysql_query($sql);
	if(mysql_num_rows($result_sql) > 0){
		while ( $nb = mysql_fetch_array($result_sql)){
			$user_name = $nb[$user_name_column_index];
		}
	}
	//echo "\$user_name is :: ".$user_name."<BR />\n";
	return $user_name;
}

function doc_state($state_index){
	$state = "";
	if($state_index == '-1'){
		$state = "Author self upload ...";
	}else if($state_index == '0'){
		$state = "Submitted, Under Review ...";
	}else if($state_index == '1'){
		$state = "Closed";
	}
	return $state;
}

function doc_decision($state_index){
	$state = "";
	if($state_index == '0'){
		$state = "Not Decided";
	}else if($state_index == '1'){
		$state = "Unaccepted";
	}else if($state_index == '2'){
		$state = "Current Accepted";
	}else if($state_index == '3'){
		$state = "Archived, Old Accepted";
	}
	return $state;
}

function comment_type($state_index){
	//comment_type::0::general comment
	//comment_type::1::review opinion
	//comment_type::2::ballot (for voting)	$state = "";
	if($state_index == '0'){
		$state = "General Comment";
	}else if($state_index == '1'){
		$state = "Review Opinion";
	}else if($state_index == '2'){
		$state = "Ballot (for voting)";
	}
	return $state;
}


?>
