<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta name="Description" content="cypriniformes, species information" />
<meta name="Keywords" content="cypriniformes, species information" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Richard Mayden - cypriniformes@gmail.com" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" href="" type="text/css" />
<title>Cypriniformes Species Search Results</title>
</head>
<body>

<?php
include('../template/dbsetup.php');
//Developed by elviscat
/*
Modification Record: Jan 22, 2009 Thursday
*/

//Get the URL GET values
//$scientific_name = htmlspecialchars($_GET['scientific_name'],ENT_QUOTES);

$genus_name = htmlspecialchars($_GET['genus_name'],ENT_QUOTES);
$species_name = htmlspecialchars($_GET['species_name'],ENT_QUOTES);
$keyword = htmlspecialchars($_GET['keyword'],ENT_QUOTES);
//$genus_name = $_GET['genus_name'];
//$species_name = $_GET['species_name'];


/*
if($scientific_name){
  echo $scientific_name;
}else if($genus_name && $species_name){
  echo $genus_name + " " + $species_name;
}else{
  echo "Your Input is not correct.";
}
*/
/*
if($genus_name && $species_name){
  echo "Both are existing.";
}else if($genus_name){
  echo "Genus name is existing.";
}else if($species_name){
  echo "Species name is existing.";
}else{
  echo "Empty Query String!!";
}
*/



//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);
//sql statement
/*
if($scientific_name){
  $temp = explode(" ", $scientific_name);
  $sql = "SELECT * FROM biglonglist WHERE mgenus = '".$temp[0]."' AND mspecies='".$temp[1]."'";
}else if($genus_name && $species_name){
  $sql = "SELECT * FROM biglonglist WHERE mgenus = '".$genus_name."' AND mspecies='".$species_name."'";
}else{
  $sql = "SELECT * FROM biglonglist WHERE mgenus = '".$genus_name."' AND mspecies='".$species_name."'";
  //break;
}
*/
if( isset($keyword) ){
  $sql = "SELECT * FROM biglonglist";
}else{
  if($genus_name && $species_name){
    if((substr($genus_name, strlen($genus_name)-1, 1) == '%' || substr($genus_name, 0, 1) == '%') && (substr($species_name, strlen($species_name)-1, 1) == '%' || substr($species_name, 0, 1) == '%')){
      //echo '1<BR>';
      $sql = "SELECT * FROM biglonglist WHERE mgenus like '".$genus_name."' AND mspecies like '".$species_name."'";
    }else if(substr($species_name, strlen($species_name)-1, 1) == '%' || substr($species_name, 0, 1) == '%'){
      //echo '2<BR>';
      $sql = "SELECT * FROM biglonglist WHERE mgenus = '".$genus_name."' AND mspecies like '".$species_name."'";
    }else if(substr($genus_name, strlen($genus_name)-1, 1) == '%' || substr($genus_name, 0, 1) == '%'){
      //echo '3<BR>';
      $sql = "SELECT * FROM biglonglist WHERE mgenus like '".$genus_name."' AND mspecies = '".$species_name."'";
    }else{
      //echo '4<BR>';
      $sql = "SELECT * FROM biglonglist WHERE mgenus = '".$genus_name."' AND mspecies = '".$species_name."'";
    }

  }else if($genus_name && !$species_name){
    if(substr($genus_name, strlen($genus_name)-1, 1) == '%' || substr($genus_name, 0, 1) == '%'){
      $sql = "SELECT * FROM biglonglist WHERE mgenus like '".$genus_name."'";
    }else{
      $sql = "SELECT * FROM biglonglist WHERE mgenus = '".$genus_name."'";
    }
  }else if($species_name && !$genus_name){
    if(substr($species_name, strlen($species_name)-1, 1) == '%' || substr($species_name, 0, 1) == '%'){
      $sql = "SELECT * FROM biglonglist WHERE mspecies like '".$species_name."'";
    }else{
      $sql = "SELECT * FROM biglonglist WHERE mspecies = '".$species_name."'";
    }
  }else{
    exit("Empty Query String!!");
    //echo "Empty Query String!!";
  }
  $sql .= " AND mpaese = 'USA'";
}

//echo "SQL is ::".$sql."<BR>";

$result=mysql_query($sql);
//$row=mysql_fetch_array($result);
//if the result exists
//loop it!!
echo "The fetch rows is ".mysql_num_rows($result).".<BR>";

if(mysql_num_rows($result) == 1){
  echo "<table width='400'>";
  //echo "<tr bgcolor=\"#FDDC99\"><td align=\"center\">Category</td><td align=\"center\">Description</td></tr>";
  $temp_counter = 0;
  while ($nb=mysql_fetch_array($result)) {
    //echo "<tr bgcolor=\"#FDDC99\"><td align=\"center\">Series Number</td><td align=\"center\">".$nb[0]."</td></tr>";
    echo "<tr bgcolor=\"#FDDC99\"><td align=\"center\">Family Name</td><td align=\"center\">".$nb[1]."</td></tr>";
    echo "<tr bgcolor=\"#FDDC99\"><td align=\"center\">Genus Name</td><td align=\"center\"><I>".$nb[2]."</I></td></tr>";
    echo "<tr bgcolor=\"#FDDC99\"><td align=\"center\">Species Name</td><td align=\"center\"><I>".$nb[3]."</I></td></tr>";
    echo "<tr bgcolor=\"#FDDC99\"><td align=\"center\">Author</td><td align=\"center\">".$nb[4]."</td></tr>";
    echo "<tr bgcolor=\"#FDDC99\"><td align=\"center\">Type of Location</td><td align=\"center\">".$nb[5]."</td></tr>";
    echo "<tr bgcolor=\"#FDDC99\"><td align=\"center\">Area Code</td><td align=\"center\">".$nb[6]."</td></tr>";
    echo "<tr bgcolor=\"#FDDC99\"><td align=\"center\">Area</td><td align=\"center\">".$nb[7]."</td></tr>";
  }
  echo "</table>";
}else if(mysql_num_rows($result) > 1){
  echo "<table width='400'>";
  echo "<tr bgcolor=\"#FDDC99\">";
  echo "<td align=\"center\">Series Number</td>";
  echo "<td align=\"center\">Family Name</td>";
  echo "<td align=\"center\">Genus Name</td>";
  echo "<td align=\"center\">Species Name</td>";
  echo "</tr>";
  
  $series_number = 0;
  while ($nb=mysql_fetch_array($result)) {
    $series_number += 1;
    echo "<tr bgcolor=\"#FDDC99\">";
    echo "<td align=\"center\">".$series_number."</td>";
    echo "<td align=\"center\">".$nb[1]."</td>";
    echo "<td align=\"center\"><I>".$nb[2]."</I></td>";
    echo "<td align=\"center\"><I><a href=\"http://idiscover.slu.edu/~wgcadmin/cypcom/ggadget/species_search.php?genus_name=".$nb[2]."&species_name=".$nb[3]."\" title=\"Click it to see the detail information!\">".$nb[3]."</a></I></td>";
    echo "</tr>";
  }
  echo "</table>";
}
else{
  echo "<p>There is no match result.</p>";
}
mysql_close($link);

?>



</body>
</html>

