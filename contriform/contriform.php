<?php 
//echo "Hello2";
session_start();
include('../template/dbsetup.php');
//security concern
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}

//Developed by elviscat
//get the posted values
$exchange = htmlspecialchars($_POST['exchange'],ENT_QUOTES);
$sig1 = htmlspecialchars($_POST['sig1'],ENT_QUOTES);
$sig2 = htmlspecialchars($_POST['sig2'],ENT_QUOTES);
$sig3 = htmlspecialchars($_POST['sig3'],ENT_QUOTES);
$sig4 = htmlspecialchars($_POST['sig4'],ENT_QUOTES);
$sig5 = htmlspecialchars($_POST['sig5'],ENT_QUOTES);
$sig6 = htmlspecialchars($_POST['sig6'],ENT_QUOTES);
$sig7 = htmlspecialchars($_POST['sig7'],ENT_QUOTES);
$sig8 = htmlspecialchars($_POST['sig8'],ENT_QUOTES);
$sig9 = htmlspecialchars($_POST['sig9'],ENT_QUOTES);
$wtb = htmlspecialchars($_POST['wtb'],ENT_QUOTES);
$wtt = htmlspecialchars($_POST['wtt'],ENT_QUOTES);

if($sig1 == 'undefined'){
	$sig1 = '';
}else{
	$sig1 .= ';';
}
if($sig2 == 'undefined'){
	$sig2 = '';
}else{
	$sig2 .= ';';
}
if($sig3 == 'undefined'){
	$sig3 = '';
}else{
	$sig3 .= ';';
}
if($sig4 == 'undefined'){
	$sig4 = '';
}else{
	$sig4 .= ';';
}
if($sig5 == 'undefined'){
	$sig5 = '';
}else{
	$sig5 .= ';';
}
if($sig6 == 'undefined'){
	$sig6 = '';
}else{
	$sig6 .= ';';
}
if($sig7 == 'undefined'){
	$sig7 = '';
}else{
	$sig7 .= ';';
}
if($sig8 == 'undefined'){
	$sig8 = '';
}else{
	$sig8 .= ';';
}
if($sig9 == 'undefined'){
	$sig9 = '';
}else{
	$sig9 .= ';';
}

$sig_total = $sig1.$sig2.$sig3.$sig4.$sig5.$sig6.$sig7.$sig8.$sig9;
$sig_total = substr($sig_total, 0, (strlen($sig_total)-1));


/*
if($exchange == '1'){
	echo "This is yes.";
}else if($exchange == '0'){
	echo "This is no.";
}else{
	echo "error";
}
*/
$sql = "Update user SET contri1='".$exchange."',contri2='".$sig_total."', contri3 = '".$wtb."', contri4 = '".$wtt."' WHERE username='".$_SESSION['username']."'";
//echo $sql;
//Developed by elviscat
//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}

//select database
mysql_select_db($dbname);

//mysql query

$result = mysql_query ($sql) or die ("Invalid query");
//$result = mysql_query($sql);
//echo "<br>".$result;

/*
if (!mysql_query($sql)) {
   	die('Could not update: ' . mysql_error());
}
*/

mysql_close($link);

?>