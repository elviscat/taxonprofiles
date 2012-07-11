<?php 
session_start();
include('../template/dbsetup.php');
//security concern
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}

//Developed by elviscat

//get the posted values
$keyword=htmlspecialchars($_POST['keyword'],ENT_QUOTES);
//echo $keyword;

//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);
//now validating the username and password
$sql = "SELECT * FROM biglonglist WHERE mfamily like '%".$keyword."%'";
$sql .= " or mgenus like '%".$keyword."%'";
$sql .= " or mspecies like '%".$keyword."%'";
$sql .= " or mauthor like '%".$keyword."%'";
$sql .= " or mtypelocal like '%".$keyword."%'";
$sql .= " or mccode like '%".$keyword."%'";
$sql .= " or mpaese like '%".$keyword."%'";

$result=mysql_query($sql);

//$row=mysql_fetch_array($result);
//if the result exists
//loop it!!

if(mysql_num_rows($result)>0){
    $sid =0;
	//while ($nb=mysql_fetch_array($result)) {
	//	$sid +=1;
	//}    
	//echo "<p>There are ".$sid." results.</p>";
	echo "<table>";
	echo "<tr><td align=\"center\">Family</td><td align=\"center\">Genus</td><td align=\"center\">Species</td>";
	while ($nb2=mysql_fetch_array($result)) {
		echo "<tr bgcolor=\"#FDDC99\">";
		echo "<td align=\"center\"><a href=\"genus.php?family=".$nb2[1]."\">".$nb2[1]."</a></td>";
		echo "<td align=\"center\"><a href=\"genus.php?family=".$nb2[2]."\">".$nb2[2]."</a></td>";
		echo "<td align=\"center\"><a href=\"genus.php?family=".$nb2[3]."\">".$nb2[3]."</a></td>";
		echo "</tr>";
	}
	echo "</table>";
	
	
	//echo $row[0]."<BR>";
	//echo $row[1]."<BR>";
	//echo $row[2]."<BR>";
	//echo $row[3]."<BR>";
	//echo $row[4]."<BR>";
	//echo $row[5]."<BR>";
	//echo $row[6]."<BR>";
}else{
	echo "<p>There is no match result.</p>"; //Invalid Login
}
?>