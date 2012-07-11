<?
session_start();
include('template/dbsetup.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
                    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <link rel="stylesheet" href="http://dev.jquery.com/view/trunk/plugins/treeview/demo/screen.css" type="text/css" />
  <link rel="stylesheet" href="http://dev.jquery.com/view/trunk/plugins/treeview/jquery.treeview.css" type="text/css" />
  <script type="text/javascript" src="http://dev.jquery.com/view/trunk/plugins/treeview/jquery.treeview.js"></script>
  <script>
  $(document).ready(function(){
    $("#example").treeview();
  });
  </script>
  
</head>
<body>
  <ul id="example" class="filetree">

<?
//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);
//now validating the username and password
$sql = "SELECT distinct(mfamily) FROM biglonglist";
$result = mysql_query($sql);
$mfamily;//delclare the variable "mfamily"

/*
if(mysql_num_rows($result)>0){
	$mfamily = $row[0];	
}else{
	//"<p>There is no match result.</p>"; //Invalid Login
}
*/

while ($nb = mysql_fetch_array($result)) {
	//echo "<li class=\"closed\"><span class=\"folder\">".$nb[0]." Author<input type=\"checkbox\" name=\"author\" value=\"1\"> Reviewer<input type=\"checkbox\" name=\"reviewer\" value=\"1\"></span>";
	echo "<li class=\"closed\"><span class=\"folder\"><a href=\"treeviewtest.php?add=".$nb[0]."\" target=_blank>".$nb[0]."</a></span>";
	echo "<ul>";
	$sql2 = "SELECT distinct(mgenus) FROM biglonglist WHERE mfamily = '".$nb[0]."'";
	$result2 = mysql_query($sql2);
	while ($nb2 = mysql_fetch_array($result2)) {
		//echo "<li class=\"closed\"><span class=\"folder\">".$nb2[0]." Author<input type=\"checkbox\" name=\"author\" value=\"1\"> Reviewer<input type=\"checkbox\" name=\"reviewer\" value=\"1\"></span>";
		echo "<li class=\"closed\"><span class=\"folder\"><a href=\"treeviewtest.php?add=".$nb[0].",".$nb2[0]."\" target=_blank>".$nb2[0]."</a></span>";
		echo "<ul>";
		//echo "<li>File 2.1.1</li>";
		//echo "<li>File 2.1.2</li>";		
		//insert the species information
		
		$sql3 = "SELECT mspecies FROM biglonglist WHERE mfamily = '".$nb[0]."' AND mgenus = '".$nb2[0]."'";
		$result3 = mysql_query($sql3);
		while ($nb3 = mysql_fetch_array($result3)) {
			//echo "<li><span class=\"file\">".$nb3[0]." Author<input type=\"checkbox\" name=\"author\" value=\"1\"> Reviewer<input type=\"checkbox\" name=\"reviewer\" value=\"1\">";
			echo "<li><span class=\"file\"><a href=\"treeviewtest.php?add=".$nb[0].",".$nb2[0].",".$nb3[0]."\" target=_blank>".$nb3[0]."</a></span>";
			echo "</span></li>";
		}
		
		echo "</ul>";
		echo "</li>";
	}
	echo "</ul>";
	echo "</li>";
	
}
?>
	</ul>
</body>
</html>
