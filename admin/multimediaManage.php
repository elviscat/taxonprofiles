<?php
  //Developed by elviscat (elviscat@gmail.com)
  //March 14, 2009 Saturday:: multimedia (include picture, video and document, etc) management interface 
  // ./ current directory
  // ../ up level directory
  
  session_start();
  if( (!isset($_SESSION['is_login'])) && ($_SESSION['role'] != "admin") ){
	  Header("location:../error.php");
	  exit();
  }
  
  $bid = htmlspecialchars($_GET['bid'],ENT_QUOTES);
  
  $table = "";
  include('../template/dbsetup.php');


  //Connect to database
  $link = mysql_connect($host , $dbuser ,$dbpasswd); 
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  //select database
  mysql_select_db($dbname);

  $sql = "SELECT * FROM adminspeciesmultimedia WHERE refid ='".$bid."'";

  $result = mysql_query($sql);
  if(mysql_num_rows($result)>0){  
    //$sid =0;
	  //while ($nb=mysql_fetch_array($result)) {
	  //	$sid +=1;
	  //}    
	  //echo "<p>There are ".$sid." results.</p>";
    $table .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"example\" width=\"640\">\n";
    $table .= "<thead>\n";
	  $table .= "<tr>";

    $table .= "<th>Serial No.</th>";
    $table .= "<th>Picture</th>";
    $table .= "<th>Date</th>";
    $table .= "<th>Reference Id</th>";
    $table .= "<th>Reference Location Id</th>";
    $table .= "<th>Description</th>";

    $table .= "<th>Edit</th>";

	  $table .= "</tr>\n";
    $table .= "</thead>\n";
    $table .= "<tbody>\n";
    while ($nb2=mysql_fetch_array($result)) {
		  $table .= "<tr>";
      $table .= "<td>".$nb2[0]."</td>";
      $table .= "<td><img src=\"../view.php?mode=adminMediaManagement&refid=".$nb2[3]."&mid=".$nb2[0]."\"></td>";
		  $table .= "<td>".$nb2[2]."</td>";
      $table .= "<td>".$nb2[3]."</td>";
      $table .= "<td>".$nb2[4]."</td>";
      $table .= "<td>".$nb2[5]."</td>";

      $table .= "<td><a href=\"multimediaEdit.php?mid=".$nb2[0]."\">Edit</a></td>";
		  $table .= "</tr>\n";
	  }
	  $table .= "</tbody>\n";
    $table .= "<tfoot>\n";
	  $table .= "<tr>";

    $table .= "<th>Serial No.</th>";
    $table .= "<th>Picture</th>";
    $table .= "<th>Date</th>";
    $table .= "<th>Reference Id</th>";
    $table .= "<th>Reference Location Id</th>";
    $table .= "<th>Description</th>";

    $table .= "<th>Edit</th>";

	  $table .= "</tr>\n";
    $table .= "</tfoot>\n";
    $table .= "</table>\n";
	}else{
	  //echo $sql;
	  $table .= "<p>There is no match result.</p>"; //Invalid Login
  }
  $table .= "<a href=\"speciesEditor2.php?sid=".$bid."\">Back to Species Editor</a>";
  mysql_close($link);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico" />
		<title>Mutlimedia Management</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demos.css";
		</style>
		<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "aesc" ]]
				} );
			} );
		</script>
	</head>
	<body id="dt_example">
		<div id="container">	
			<h1>Mutlimedia Management</h1>
      <div id="demo">
<!--Table is here!!-->
<?php
  echo $table;
?>
<!--Table is here!!-->
			</div>
			<div class="spacer"></div>
			
			<div id="footer" style="text-align:center;">
				<!--<span style="font-size:10px;">
					DataTables &copy; Allan Jardine 2008-2009.<br>
					Information in the table &copy; <a href="http://www.u4eatech.com">U4EA Technologies</a> 2007-2009.</span>-->
			</div>
		</div>
	</body>
</html>
