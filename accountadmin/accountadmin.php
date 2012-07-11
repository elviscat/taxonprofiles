<?php 
//echo "Hello1";
session_start();
include('../template/dbsetup.php');
//security concern
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}
/******************************
**	accountadmin.php
**	elviscat@gmail.com
**  Elvis Wu
**  09/12/2008
**  version2:
**  09/15/2008
**  version3:
**  05/20/2009 Wednesday
**  version4:
**  05/21/2009 Thursday
*******************************/
//get the posted values
$author_family = htmlspecialchars($_POST['author_family'],ENT_QUOTES);
$author_genus = htmlspecialchars($_POST['author_genus'],ENT_QUOTES);
$author_species = htmlspecialchars($_POST['author_species'],ENT_QUOTES);
$reviewer_family = htmlspecialchars($_POST['reviewer_family'],ENT_QUOTES);
$reviewer_genus = htmlspecialchars($_POST['reviewer_genus'],ENT_QUOTES);
$reviewer_species = htmlspecialchars($_POST['reviewer_species'],ENT_QUOTES);

$family_name = htmlspecialchars($_POST['getFamily'],ENT_QUOTES);
$genus_name = htmlspecialchars($_POST['getGenus'],ENT_QUOTES);
//echo $family_name."\n";
//echo $genus_name."\n";

/*
echo $author_family;
echo $author_genus;
echo strlen($author_species);
*/
//echo $reviewer_family;
//echo strlen($reviewer_genus);
//echo strlen($reviewer_species);
//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);


/* Example
$post_data = $author_family;
$acclevel = "family";
$acclevelname = "all";
$acctype = "author";
*/
function update($post_data,$acclevel,$acclevelname,$acctype){
  //Step 1:: Delete the data which the new post data doesn't have
  //Step 2:: Keep the data which is already in database 
  //Step 3:: Insert the new data into TABLE::account_author_reviewer
  $original_data = array();
  $counter = 0;
  $pre_sql = "SELECT * FROM account_author_reviewer WHERE accowner ='".$_SESSION['username']."' AND acclevel='".$acclevel."' AND acctype='".$acctype."' AND acclevelname='".$acclevelname."'";//2.modulate
  $pre_result = mysql_query ($pre_sql) or die ("Invalid query");
  while ($pre_result_array = mysql_fetch_array($pre_result)) {
    //echo "pre_result_array is ".$pre_result_array[4]."\n";
    $original_data[$counter] = $pre_result_array[4];//
    $counter++;
  }
  if(strlen($post_data) != 0){//
    $post_data = substr($post_data, 0, (strlen($post_data)-1));//5.modulate
	  $temp = explode(";", $post_data);//
    $temp_array = array();
    $temp_array_counter = 0;
    for($i = 0 ; $i < sizeof($original_data) ; $i++){//7.modulate
      $keep_checker = false;
      for($j = 0 ; $j < sizeof($temp) ; $j++){
		    $temp2 = explode("_", $temp[$j]);
        //echo $temp[$j]."is ".$original_data[$i]."\n";//8.modulate
        if($original_data[$i] == $temp2[2]){//9.modulate
          $temp_array[$temp_array_counter] = $original_data[$i];//10.modulate
          $temp_array_counter++;
          //echo "Keep this!:: ".$original_data[$i]."\n";//11.modulate
          $keep_checker = true;
        }
      }
      if( $keep_checker == false ){
        //echo "Delete this!:: ".$original_data[$i]."\n";//12.modulate
        //Delete SQL
        $delete_sql1 = "DELETE FROM account_author_reviewer WHERE accowner='".$_SESSION['username']."' and accname ='".$original_data[$i]."' AND acctype='".$acctype."'";//13.modulate
        //echo $sql."\n";
        mysql_query ($delete_sql1) or die ("Invalid query1");
      }
	  }
    for($i = 0 ; $i < sizeof($temp) ; $i++){
      $insert_checker = true;
      $temp2 = explode("_", $temp[$i]);
      for($j = 0 ; $j < sizeof($temp_array) ; $j++){
        //echo "tmep_array[j] is ".$temp_array[$j]."\n";
        if($temp2[2] == $temp_array[$j]){
          $insert_checker = false;
        }
      }
      if( $insert_checker == true ){
        //echo "Insert this!:: ".$temp[$i]."\n";
        $find_maxsid_sql = "SELECT (Max(sid)+1) FROM account_author_reviewer";
        $find_maxsid_result = mysql_query ($find_maxsid_sql) or die ("Invalid query");
        list($maxsid) = mysql_fetch_row($find_maxsid_result);
        if($maxsid == 0){
	        $maxsid = 1;
        }
        for($k = 0 ; $k < $maxsid ; $k++){
          $check_sql = "SELECT * FROM account_author_reviewer WHERE sid='".($k+1)."'";
          $check_result = mysql_query ($check_sql) or die ("Invalid query");
          list($check_result_set) = mysql_fetch_row($check_result);
          if($check_result_set == 0){
	          $temp_sid = $k+1;
            //echo "You can insert in sid = ".($k+1)." .\n";
	          $insert_sql = "INSERT INTO account_author_reviewer ";
		        $insert_sql .= " (sid,accowner,acclevel,acclevelname,accname,acctype) VALUES";
		        $insert_sql .= " ('$temp_sid','$temp2[0]','$temp2[1]','$acclevelname','$temp2[2]','$temp2[3]')";
		        //echo $insert_sql."\n";  
            mysql_query ($insert_sql) or die ("Invalid query");
            break; 
          }
        }
      }  	
	  }
  }else{
    for($i = 0 ; $i < sizeof($original_data) ; $i++){//14.modulate
      //echo "Delete it!:: ".$original_data[$i]."\n";//15.modulate
      $delete_sql2 = "DELETE FROM account_author_reviewer WHERE accowner='".$_SESSION['username']."' AND accname ='".$original_data[$i]."' AND acctype='".$acctype."'";//16.modulate
      //echo $sql;
      mysql_query ($delete_sql2) or die ("Invalid query");	
	  }
  }
}

update($author_family,"family","all","author");
update($reviewer_family,"family","all","reviewer");
update($author_genus,"genus",$family_name,"author");
update($reviewer_genus,"genus",$family_name,"reviewer");
update($author_species,"species",$genus_name,"author");
update($reviewer_species,"species",$genus_name,"reviewer");


mysql_query ("OPTIMIZE TABLE account_author_reviewer") or die ("Invalid query");
mysql_close($link);

?>