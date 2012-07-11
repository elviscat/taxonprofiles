<?
session_start();
include('../template/dbsetup.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Test--jQuery treeTable Plugin Documentation</title>
  <link href="stylesheets/master.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="javascripts/jquery.js"></script>
  <script type="text/javascript" src="javascripts/jquery.ui.js"></script>
  <!-- BEGIN Plugin Code -->
  <link href="stylesheets/jquery.treeTable.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="javascripts/jquery.treeTable.min.js"></script>
  <script type="text/javascript">
  
  $(document).ready(function() {
    $(".example").treeTable();
  });
  
  </script>
  <!-- END Plugin Code -->
</head>
<body>

<?
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}
//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);

?>

<?
/************************************/
/***Start of the Pre SQL Prccedure***/
/***Start of the Pre SQL Prccedure***/
/************************************/
$author_family = array();
$author_genus = array();
$author_species = array();
$reviewer_family = array();
$reviewer_genus = array();
$reviewer_species = array();
$counter = 0;
$pre_sql = "SELECT * FROM account_author_reviewer WHERE accowner ='".$_SESSION['username']."' AND acclevel='family' AND acctype='author'";
$pre_result = mysql_query ($pre_sql) or die ("Invalid query");
while ($pre_result_array = mysql_fetch_array($pre_result)) {
	$author_family[$counter] = $pre_result_array[2];
	$counter++;
}
/*
for($i = 0; $i <= sizeof($author_family); $i++){
	echo $author_family[$i]."<BR>";
}
*/
$counter = 0;
$pre_sql2 = "SELECT * FROM account_author_reviewer WHERE accowner ='".$_SESSION['username']."' AND acclevel='genus' AND acctype='author'";
$pre_result2 = mysql_query ($pre_sql2) or die ("Invalid query");
while ($pre_result_array2 = mysql_fetch_array($pre_result2)) {
	$author_genus[$counter] = $pre_result_array2[2];
	$counter++;
}
$counter = 0;
$pre_sql3 = "SELECT * FROM account_author_reviewer WHERE accowner ='".$_SESSION['username']."' AND acclevel='species' AND acctype='author'";
$pre_result3 = mysql_query ($pre_sql3) or die ("Invalid query");
while ($pre_result_array3 = mysql_fetch_array($pre_result3)) {
	$author_species[$counter] = $pre_result_array3[2];
	$counter++;
}

$counter = 0;
$pre_sql4 = "SELECT * FROM account_author_reviewer WHERE accowner ='".$_SESSION['username']."' AND acclevel='family' AND acctype='reviewer'";
$pre_result4 = mysql_query ($pre_sql4) or die ("Invalid query");
while ($pre_result_array4 = mysql_fetch_array($pre_result4)) {
	$reviewer_family[$counter] = $pre_result_array4[2];
	$counter++;
}

$counter = 0;
$pre_sql5 = "SELECT * FROM account_author_reviewer WHERE accowner ='".$_SESSION['username']."' AND acclevel='genus' AND acctype='reviewer'";
$pre_result5 = mysql_query ($pre_sql5) or die ("Invalid query");
while ($pre_result_array5 = mysql_fetch_array($pre_result5)) {
	$reviewer_genus[$counter] = $pre_result_array5[2];
	$counter++;
}
$counter = 0;
$pre_sql6 = "SELECT * FROM account_author_reviewer WHERE accowner ='".$_SESSION['username']."' AND acclevel='species' AND acctype='reviewer'";
$pre_result6 = mysql_query ($pre_sql6) or die ("Invalid query");
while ($pre_result_array6 = mysql_fetch_array($pre_result6)) {
	$reviewer_species[$counter] = $pre_result_array6[2];
	$counter++;
}
/**********************************/
/***End of the Pre SQL Prccedure***/
/***End of the Pre SQL Prccedure***/
/**********************************/

?>


<h3>1. <a name="example">The cypriniformes tree</a></h3>

<table class="example">
  <caption>Example 1: A cypriniformes tree.</caption>

<?php
  $sql = "SELECT distinct(mfamily) FROM biglonglist";
  $result = mysql_query ($sql) or die ("Invalid query");
  if(mysql_num_rows($result)>0){
    $sid =0;
	//while ($nb=mysql_fetch_array($result)) {
	//	$sid +=1;
	//}    
	//echo "<p>There are ".$sid." results.</p>";
	
	//echo "<table>";
	echo "<tr>";
	echo "<td align=\"left\">Taxon</td>";
	echo "<td align=\"center\">Author</td>";
	echo "<td align=\"center\">Reviewer</td>";
	echo "</tr>\n";
	
	$family_counter = 0;
	while ($nb=mysql_fetch_array($result)) {
	  $family_counter++;
	  echo "<tr id=\"node-".$family_counter."\">";
      echo "<td>".$nb[0]."</td>";
      echo "<td align=\"center\"><input type=\"checkbox\" name=\"author_family_".$family_counter."\" value=\"".$nb[0]."\" ";
	  for($i = 0; $i <= sizeof($author_family); $i++){
	    if($author_family[$i] == $nb[0]){
		  echo "checked";
		  break;
		}
	  }
	  echo "></td>";
	  echo "<td align=\"center\"><input type=\"checkbox\" name=\"reviewer_family_".$family_counter."\" value=\"".$nb[0]."\" ";
	  for($i = 0; $i <= sizeof($reviewer_family); $i++){
	    if($reviewer_family[$i] == $nb[0]){
		  echo "checked";
		  break;
		}
	  }
	  echo "></td>";
      echo "</tr>\n";
	  $sql2 = "SELECT distinct(mgenus) FROM biglonglist WHERE mfamily = '".$nb[0]."'";
	  //echo $sql2."<br>";
	  $result2 = mysql_query($sql2);
	  $genus_counter = 0;
	  while ($nb2 = mysql_fetch_array($result2)) {			
	    $genus_counter++;
	    echo "<tr id=\"node-".$family_counter."-".$genus_counter."\" class=\"child-of-node-".$family_counter."\">";
        echo "<td>".$nb2[0]."</td>";
        echo "<td align=\"center\"><input type=\"checkbox\" name=\"author_genus_".$genus_counter."\" value=\"".$nb2[0]."\" ";
	    for($i = 0; $i <= sizeof($author_genus); $i++){
	      if($author_genus[$i] == $nb2[0]){
		    echo "checked";
		    break;
		  }
	    }
	    echo "></td>";
	    echo "<td align=\"center\"><input type=\"checkbox\" name=\"reviewer_genus_".$genus_counter."\" value=\"".$nb2[0]."\" ";
	    for($i = 0; $i <= sizeof($reviewer_genus); $i++){
	      if($reviewer_genus[$i] == $nb2[0]){
		    echo "checked";
		    break;
		  }
	    }
	    echo "></td>";
        echo "</tr>\n";
	    $sql3 = "SELECT distinct(mspecies) FROM biglonglist WHERE mgenus = '".$nb2[0]."'";
	    //echo $sql3."<br>";
	    $result3 = mysql_query($sql3);
	    $species_counter = 0;
	    while ($nb3 = mysql_fetch_array($result3)) {			
	      $species_counter++;
	      echo "<tr id=\"node-".$family_counter."-".$genus_counter."-".$species_counter."\" class=\"child-of-node-".$family_counter."-".$genus_counter."\">";
          echo "<td>".$nb3[0]."</td>";
          echo "<td align=\"center\"><input type=\"checkbox\" name=\"author_species_".$species_counter."\" value=\"".$nb3[0]."\" ";
	      for($i = 0; $i <= sizeof($author_species); $i++){
	        if($author_species[$i] == $nb3[0]){
		      echo "checked";
		      break;
		    }
	      }
	      echo "></td>";
	      echo "<td align=\"center\"><input type=\"checkbox\" name=\"reviewer_species_".$species_counter."\" value=\"".$nb3[0]."\" ";
	      for($i = 0; $i <= sizeof($reviewer_species); $i++){
	        if($reviewer_species[$i] == $nb3[0]){
		      echo "checked";
		      break;
		    }
	      }
	      echo "></td>";
          echo "</tr>\n";
	    }
	  }
    }
  }
  mysql_close($link);
?>
</table>
</body>
</html>