<?php 
session_start();
include('../template/dbsetup.php');
//Developed by elviscat

/*
get the posted values
$keyword = htmlspecialchars($_POST['keyword'],ENT_QUOTES);
$Genus_name = htmlspecialchars($_POST['Genus_name'],ENT_QUOTES);
$Species_name = htmlspecialchars($_POST['Species_name'],ENT_QUOTES);
echo $keyword;
*/

$queryString = htmlspecialchars($_POST['queryString'],ENT_QUOTES);
//$queryString = $_POST['queryString'];
//echo "queryString is ::".$queryString."\n<BR>";
$queryStringArray = explode("&amp;", $queryString);

$search_type;
$sci_name;
$genus_name;
$species_name;
for ($i =0 ; $i < sizeof($queryStringArray); $i++){
  //echo "queryStringArray[".$i."] is ".$queryStringArray[$i]."\n<br>";
  $queryStringArray2 = explode("=", $queryStringArray[$i]);
  if($queryStringArray2[0] == 'search_type'){
    $search_type = $queryStringArray2[1];
  }
  if($queryStringArray2[0] == 'sci_name'){
    $sci_name = $queryStringArray2[1];
  }
  if($queryStringArray2[0] == 'genus_name'){
    $genus_name = $queryStringArray2[1];
  }
  if($queryStringArray2[0] == 'species_name'){
    $species_name = $queryStringArray2[1];
  }  
  /*
  for ($j =0 ; $j < sizeof($queryStringArray2); $j++){
    echo "queryStringArray2[".$j."] is ".$queryStringArray2[$j]."\n<br>";
  }
  */
  
}
$sql;
echo "<p>";
if( $search_type == "sci_name" ){
  if( $sci_name != null){
    //echo "Go to scientific name search!";
    //Go to scientific search
    //echo "sci_name is ::".$sci_name."\n<br>";
    $sci_name2 = explode("+", $sci_name);
    $sql = "SELECT * FROM biglonglist WHERE mgenus = '".$sci_name2[0]."' AND mspecies = '".$sci_name2[1]."'";    
  }else{
    echo "You need to enter your scientific name!";
    exit;
  }
}else if( $search_type == "genus_or_species" ){
  if( $genus_name != null){
    //echo "Go to genus name search!";
    //Go to genus name search
    //echo "genus_name is ::".$genus_name."\n<br>";
    //echo "first is ::".substr($genus_name,0,1)."\n<br>";
    //echo "last is ::".substr($genus_name,(strlen($genus_name)-1),1)."\n<br>";
    $genus_name = str_replace('%25', '%', $genus_name);
    //echo "genus_name is::".$genus_name."\n<br>";
    if( substr($genus_name,0,1) == '%' && substr($genus_name,-1) == '%' ){
      $sql = "SELECT * FROM biglonglist WHERE mgenus like '".$genus_name."'";
    }else if(substr($genus_name,0,1) == '%'){
      $sql = "SELECT * FROM biglonglist WHERE mgenus like '".$genus_name."'";    
    }else if(substr($genus_name,-1) == '%'){
      $sql = "SELECT * FROM biglonglist WHERE mgenus like '".$genus_name."'";
    }else{
      $sql = "SELECT * FROM biglonglist WHERE mgenus = '".$genus_name."'";
    }    
    if( $species_name != null){
      //echo "Go to genus name and species name search!";
      $species_name = str_replace('%25', '%', $species_name);
      //echo "genus_name is::".$genus_name."\n<br>";
      if( substr($species_name,0,1) == '%' && substr($species_name,-1) == '%' ){
        $sql .= " AND mspecies like '".$species_name."'";
      }else if(substr($species_name,0,1) == '%'){
        $sql .= " AND mspecies like '".$species_name."'";
      }else if(substr($species_name,-1) == '%'){
        $sql .= " AND mspecies like '".$species_name."'";
      }else{
        $sql .= " AND mspecies = '".$species_name."'";
      }
    }else{//$genus_name is null and $species_name is null
      //echo "You need to enter your species name!";
      echo "<br>You can add the species name for more specific search!\n<br>";
    }
    
  }else{
    //echo "You need to enter your genus name!";
    if( $species_name != null){
      //echo "Go to species name search!";
      $species_name = str_replace('%25', '%', $species_name);
      //echo "genus_name is::".$genus_name."\n<br>";
      if( substr($species_name,0,1) == '%' && substr($species_name,-1) == '%' ){
        $sql = "SELECT * FROM biglonglist WHERE mspecies like '".$species_name."'";
      }else if(substr($species_name,0,1) == '%'){
        $sql = "SELECT * FROM biglonglist WHERE mspecies like '".$species_name."'";
      }else if(substr($species_name,-1) == '%'){
        $sql = "SELECT * FROM biglonglist WHERE mspecies like '".$species_name."'";
      }else{
        $sql = "SELECT * FROM biglonglist WHERE mspecies = '".$species_name."'";
      }
      echo "<br>You can add the genus name for more specific search!\n<br>";
    }else{
      echo "<br>You need type at least one name!\n<br>";
      exit;
    }
    
  }
}else{
  echo "<br>You need to choose one type!\n<br>";
  exit;
}


//Then, execute the sql command
//echo "<br>".$sql."\n<br>";

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

$result=mysql_query($sql);
if(mysql_num_rows($result)>0){
  //echo $sql;
  $sid =0;
  //while ($nb=mysql_fetch_array($result)) {
  //	$sid +=1;
  //}    
  //echo "<p>There are ".$sid." results.</p>";
  echo "<table>";
  //echo "<tr><td align=\"center\">Family</td><td align=\"center\">Genus</td><td align=\"center\">Species</td><td align=\"center\">Holder</td>";
  echo "<tr>";
  //echo "<td align=\"center\">Family Name</td>";
  //echo "<td align=\"center\">Genus Name</td>";
  //echo "<td align=\"center\">Species Name</td>";
  //echo "<td align=\"center\">Holder</td>";
  while ($nb2=mysql_fetch_array($result)) {
    echo "<tr bgcolor=\"#FDDC99\">";
	echo "<td align=\"center\">".$nb2[1]."</td>";
	echo "<td align=\"center\"><i>".$nb2[2]."</i></td>";
	echo "<td align=\"center\"><a href=\"viewtaxon.php?id=".$nb2[0]."\"><i>".$nb2[3]."</i></a></td>";
	//echo "<td align=\"center\"><a href=\"viewaccount.php?id=".$nb2[0]."\"><i>".$nb2[3]."</i></a></td>";
    //echo "<td align=\"center\"><a href=\"genus.php?family=".$nb2[1]."\">".$nb2[1]."</a>(Change?)</td>";
	//echo "<td align=\"center\"><a href=\"genus.php?family=".$nb2[2]."\">".$nb2[2]."</a></td>";
	//echo "<td align=\"center\"><a href=\"genus.php?family=".$nb2[3]."\">".$nb2[3]."</a></td>";
    //echo "<td align=\"center\">elviscat</td>";
	echo "</tr>";
  }
  echo "</table>";
}else{
  echo "<h3>There is no match result.</h3>"; //Invalid Login
}
mysql_close($link);
echo "</p>";
?>
