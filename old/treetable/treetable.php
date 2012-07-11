<?php 
//echo "Hello2";
session_start();
include('../template/dbsetup.php');
//security concern
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}
/******************************
**	treetable.php
**	elviscat@gmail.com
**  Elvis Wu
**  09/12/2008
**  version2:
**  09/??/2008
*******************************/
//get the posted values
$author_family = htmlspecialchars($_POST['author_family'],ENT_QUOTES);
$author_genus = htmlspecialchars($_POST['author_genus'],ENT_QUOTES);
$author_species = htmlspecialchars($_POST['author_species'],ENT_QUOTES);
$reviewer_family = htmlspecialchars($_POST['reviewer_family'],ENT_QUOTES);
$reviewer_genus = htmlspecialchars($_POST['reviewer_genus'],ENT_QUOTES);
$reviewer_species = htmlspecialchars($_POST['reviewer_species'],ENT_QUOTES);

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
//mysql query

//Step1::delete all data whose owner is "$_SESSION['username']"
$sql = "DELETE FROM account_author_reviewer WHERE accowner='".$_SESSION['username']."'";
//echo $sql;
mysql_query ($sql) or die ("Invalid query");


//Step2::insert these data into TABLE::account_author_reviewer
if(strlen($author_family) != 0){
	$author_family = substr($author_family, 0, (strlen($author_family)-1));
	$temp = explode(";", $author_family);
	//echo $temp[0];
	for($i = 0 ; $i < sizeof($temp) ; $i++){
		$temp2 = explode("_", $temp[$i]);
		$temp3 = "INSERT INTO account_author_reviewer ";
		$temp3 .= " (accowner,acclevel,accname,acctype) VALUES";
		$temp3 .= " ('$temp2[0]','$temp2[1]','$temp2[2]','$temp2[3]')";
		//echo $temp3;
		mysql_query ($temp3) or die ("Invalid query");
	}
}
if(strlen($author_genus) != 0){
	$author_genus = substr($author_genus, 0, (strlen($author_genus)-1));
	$temp = explode(";", $author_genus);
	//echo $temp[0];
	for($i = 0 ; $i < sizeof($temp) ; $i++){
		$temp2 = explode("_", $temp[$i]);
		$temp3 = "INSERT INTO account_author_reviewer ";
		$temp3 .= " (accowner,acclevel,accname,acctype) VALUES";
		$temp3 .= " ('$temp2[0]','$temp2[1]','$temp2[2]','$temp2[3]')";
		//echo $temp3;
		mysql_query ($temp3) or die ("Invalid query");
	}
}
if(strlen($author_species) != 0){
	$author_species = substr($author_species, 0, (strlen($author_species)-1));
	$temp = explode(";", $author_species);
	//echo $temp[0];
	for($i = 0 ; $i < sizeof($temp) ; $i++){
		$temp2 = explode("_", $temp[$i]);
		$temp3 = "INSERT INTO account_author_reviewer ";
		$temp3 .= " (accowner,acclevel,accname,acctype) VALUES";
		$temp3 .= " ('$temp2[0]','$temp2[1]','$temp2[2]','$temp2[3]')";
		//echo $temp3;
		mysql_query ($temp3) or die ("Invalid query");
	}
}

if(strlen($reviewer_family) != 0){
	$reviewer_family = substr($reviewer_family, 0, (strlen($reviewer_family)-1));
	$temp = explode(";", $reviewer_family);
	//echo $temp[0];
	for($i = 0 ; $i < sizeof($temp) ; $i++){
		$temp2 = explode("_", $temp[$i]);
		$temp3 = "INSERT INTO account_author_reviewer ";
		$temp3 .= " (accowner,acclevel,accname,acctype) VALUES";
		$temp3 .= " ('$temp2[0]','$temp2[1]','$temp2[2]','$temp2[3]')";
		//echo $temp3;
		mysql_query ($temp3) or die ("Invalid query");
	}
}
if(strlen($reviewer_genus) != 0){
	$reviewer_genus = substr($reviewer_genus, 0, (strlen($reviewer_genus)-1));
	$temp = explode(";", $reviewer_genus);
	//echo $temp[0];
	for($i = 0 ; $i < sizeof($temp) ; $i++){
		$temp2 = explode("_", $temp[$i]);
		$temp3 = "INSERT INTO account_author_reviewer ";
		$temp3 .= " (accowner,acclevel,accname,acctype) VALUES";
		$temp3 .= " ('$temp2[0]','$temp2[1]','$temp2[2]','$temp2[3]')";
		//echo $temp3;
		mysql_query ($temp3) or die ("Invalid query");
	}
}
if(strlen($reviewer_species) != 0){
	$reviewer_species = substr($reviewer_species, 0, (strlen($reviewer_species)-1));
	$temp = explode(";", $reviewer_species);
	//echo $temp[0];
	for($i = 0 ; $i < sizeof($temp) ; $i++){
		$temp2 = explode("_", $temp[$i]);
		$temp3 = "INSERT INTO account_author_reviewer ";
		$temp3 .= " (accowner,acclevel,accname,acctype) VALUES";
		$temp3 .= " ('$temp2[0]','$temp2[1]','$temp2[2]','$temp2[3]')";
		//echo $temp3;
		mysql_query ($temp3) or die ("Invalid query");
	}
}


mysql_close($link);

?>