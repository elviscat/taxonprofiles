<?php 
  //Developed by elviscat (elviscat@gmail.com)
  //March 13, 2009 Friday::blog detail page
  // ./ current directory
  // ../ up level directory
  //!?!?
  session_start();
  //!?!?
  
  $table = "";
  $replyTitle = "";
  include('../template/dbsetup.php');

  //Connect to database
  $link = mysql_connect($host , $dbuser ,$dbpasswd); 
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  //select database
  mysql_select_db($dbname);

  $pid = $_GET['pid'];

  $sql = "SELECT * FROM post WHERE pid= '".$pid."'";  
  //echo "<BR>sql is ".$sql;
  
  $result = mysql_query($sql);
  if( mysql_num_rows($result) > 0 ){  
    while ( $nb2 = mysql_fetch_array($result) ) {
		  $table .= "<p>".$nb2[3];//create time
      $table .= "<p><h2><b>".$nb2[1]."</b></h2></p>";//title
      
      $replyTitle = $nb2[1];
      
      
      $table .= "<p>".$nb2[2]."</p><BR>";// full content
      //$table .= "<p><a href=\detail.php?pid=".$nb2[0]."\">More</a><BR><BR>";
      
      $name = "";
      if( $nb2[4] == 0){
        $name = "admin";
      }else{
        $sql2 = "SELECT name FROM user WHERE uid ='".$nb2[4]."'";
        $result2 = mysql_query($sql2);
        //echo "sql2 is ".$sql2;
        $name = mysql_result($result2, 0);
      }
      
      $sql3 = "SELECT COUNT(*) FROM comment WHERE crefpid= '".$nb2[0]."'";
      //echo "sql3 is ".$sql3;
      $result3 = mysql_query($sql3);
      $commentCount = mysql_result($result3, 0);
      
      
      
      $table .= "<B>".$name."</B> at <B>".$nb2[3]."</B> Post | Comment (<B>".$commentCount."</B>)<BR><BR>";
      
      
      
      $table .= "<hr NOSHADE>";
      
      
      
      
	  }

	}else{
	  //echo $sql;
	  $table .= "<p>Currently, there are no entries under this blog.</p>"; //no records here
  }
  
  $table .= "<BR><BR><a href=\"../index.php\">Back to homepage</a>";
  
  
  $sql = "SELECT * FROM comment WHERE crefpid= '".$pid."'";  
  //echo "<BR>sql is ".$sql;
  
  $result = mysql_query($sql);
  
  $table .= "<p>Comment</p>";
  
  if( mysql_num_rows($result) > 0 ){  
    $commentCounter = 0;
    while ( $nb2 = mysql_fetch_array($result) ) {
		  $commentCounter += 1;
      
      $table .= "<p><h2><b>".$nb2[1]."</b></h2></p>";//ctitle
      $table .= "<p>".$nb2[2]."</p><BR>";// full ccontent
      //$table .= "<p><a href=\detail.php?pid=".$nb2[0]."\">More</a><BR><BR>";
            
      
      
      $table .= "<B>".$nb2[5]."</B> at <B>".$nb2[3]."</B> Comment<BR><BR>";
      
      
      
      $table .= "<hr NOSHADE>";
      
      
      
      
	  }

	}else{
	  //echo $sql;
	  $table .= "<p>Currently, there are no entries under this blog.</p>"; //no records here
  }  
  
  
  
  
  
  mysql_close($link);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<!--<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico" />-->
		<title>BLog Entry Detail</title>
		<link rel="stylesheet" href="edit.css" type="text/css" />
    <style type="text/css" title="currentStyle">
			@import "media/css/demos.css";
		</style>
		<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					//"aaSorting": [[ 4, "desc" ]]
					//"aaSorting": [[0,'asc'], [1,'desc'], [2,'desc']]
					//"aaSorting": [[0,'asc'], [1,'asc']]
					"aaSorting": [[1,'asc'], [2,'asc'], [3,'asc']]
				} );
			} );
		</script>
    <script type="text/javascript">
    <!--
      function confirmation(a) {
	    var answer = confirm("Delete it?")
	      if (answer){
		      alert("Ok, We will delete this post entry.")
		      window.location = "deletePost.php?pid=" + a;
	      }else{
		      alert("You are clever, not delete me!")
		      return false;
	      }
      }
    //-->
    </script>
	</head>
	<body id="dt_example">
		<div id="container">	
			<h1>BLog Entry Detail</h1>
			<?php
        //if( !isset($_SESSION['loginName']) || ($_SESSION['loginName'] != "admin") ){
        //  echo "<h2><a href=\"login.php\">Login</a></h2>";
        //}else{
        //  echo "<h2><a href=\"logout.php\">Logout</a></h2>";
        //}
			?>
      <div id="demo">
      <!--Table is here!!-->
      <?php 
        echo $table;
      ?>
      <!--Table is here!!-->
			</div>
      <div class="spacer"></div>
      
			<div id="footer" style="text-align:center;">
				<!--
        <span style="font-size:10px;">
					DataTables &copy; Allan Jardine 2008-2009.<br>
					Information in the table &copy; <a href="http://www.u4eatech.com">U4EA Technologies</a> 2007-2009.</span>-->
			</div>
		</div>
		<!--Comment Post Form-->
    <div id="basic" class="myform">
      <h1>Add a new comment!</h1>
      <p>Please leave you comment here.</p>
      <form id="commentPost" action="commentPost.php" method="post">
        <label>Title
          <span class="small">Add title</span>
        </label>
          <input id="crefpid" name="crefpid" type="hidden" value="<? echo $pid; ?>" />
          <input id="ctitle" name="ctitle" type="text" size="100" value="<? echo "RE:".$replyTitle; ?>" />
	      <label>Name
          <span class="small">Add your name</span>
        </label>
          <input id="cname" name="cname" type="text" size="100" value="" />
	      <label>Web Site
          <span class="small">Add your website</span>
        </label>
          <input id="cwebsite" name="cwebsite" type="text" size="100" value="" />
	      <label>Msn
          <span class="small">Add your msn</span>
        </label>
          <input id="cmsn" name="cmsn" type="text" size="100" value="" />
	      <label>Comment
          <span class="small">Add your comment</span>
        </label>
          <!--<span class="small">--><textarea name="ccontent" rows="30" cols="30"></textarea><!--</span><p>-->
        <button  type="submit">Post it!</button>
      </form>
      <br><br>
      <!--<div align="center"><p><a href="index.php">Back to management page</a></p></div>-->
      <!--<div align="center"><a href="../index.php">Return to index</a><br></div>-->
    </div>
    <!--Comment Post Form-->      
	</body>
</html>


