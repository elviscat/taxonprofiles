<?php
  //Developed by elviscat (elviscat@gmail.com)
  //March 12, 2009 Thursday:: add location information to database
  // ./ current directory
  // ../ up level directory

  session_start();
  if( (!isset($_SESSION['is_login'])) && ($_SESSION['role'] != "admin") ){
	  Header("location:../error.php");
	  exit();
  }  
  $bid = htmlspecialchars($_POST['bid'],ENT_QUOTES);
  $intLatLng = htmlspecialchars($_POST['inLatLng'],ENT_QUOTES);
  $desc = htmlspecialchars($_POST['desc'],ENT_QUOTES);
  
  //echo $bid."<BR>";
  //echo $intLatLng."<BR>";
  //echo $desc."<BR>";

  $intLatLng = substr($intLatLng, 1, -1);
  $intLatLng2 = explode(",", $intLatLng);
  $intLatLng2[1] = substr($intLatLng2[1], 1);
  
  //echo $intLatLng2[0]."<BR>";
  //echo $intLatLng2[1]."<BR>";
  
  include('../template/dbsetup.php');
  //Connect to database
  $link = mysql_connect($host , $dbuser ,$dbpasswd); 
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  //select database
  mysql_select_db($dbname);
  //sql statement

  //echo "Hello Elvis";
  
  $maxLid = 0;
  $maxLidSql = "SELECT MAX(lid) FROM adminspecieslocation";
  $result = mysql_query ($maxLidSql) or die ("Invalid query");
  if( mysql_num_rows( $result) > 0 ){
	  while ( $nb2 = mysql_fetch_array($result)) {
		  $maxLid = $nb2[0] + 1;
		  //echo "11maxLid is ".$maxLid."<br>";
	  }
  }else{
    $maxLid = 1;
  }
  echo "maxLid is ".$maxLid."<br>";
  $date = date("Y-m-d H:i:s");//"2008-08-28 11:03:21"

  //select database
  mysql_select_db($dbname);
  //sql statement
  $sql = "INSERT INTO adminspecieslocation (`lid`, `lat`, `long`, `date`, `descr`, `refid`) VALUES ";
  $sql .= "('".$maxLid."', '".$intLatLng2[0]."', '".$intLatLng2[1]."', '".$date."', '".$desc."', '".$bid."')";
  //echo $sql;
  mysql_query($sql);
  mysql_close($link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Your result</title>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA53TeMwGJV1oqIQjLa45WyxTO77323e5EQasSc_FJjkcu6rRTGRQiV1KZDp2WvKjIDfygjeGmfPEyhg"
      type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function load() {
	if (GBrowserIsCompatible()) {
		var myMap = new GMap2(document.getElementById("my_map"));
		myMap.setCenter(new GLatLng(<? echo $intLatLng2[0]; ?>, <? echo $intLatLng2[1]; ?>), 11);
		
		var myMarker = new GMarker( new GLatLng(<? echo $intLatLng2[0]; ?>, <? echo $intLatLng2[1]; ?>) );
		myMap.addOverlay( myMarker );
		
		myMarker.openInfoWindowHtml( "<? echo $desc; ?>" );
	}
}
//]]>
</script>
</head>
<body onload="load()" onunload="GUnload()">
    <div id="my_map" style="width: 500px; height: 500px"></div>
    <a href="geocoding.php?bid=<? echo $bid; ?>">Back to Geocoding</a>
    <a href="speciesEditor2.php?sid=<? echo $bid; ?>">Back to Editor</a>
</body>
</html>