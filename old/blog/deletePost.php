<?php
  //Developed by elviscat (elviscat@gmail.com)
  //March 13, 2009 Friday::new blog entry post::delete this entry(record) into the table::post
  // ./ current directory
  // ../ up level directory
  session_start();
  if( (!isset($_SESSION['is_login'])) ){
	  Header("location:../error.php");
	  exit();
  }
  $pid = htmlspecialchars($_GET['pid'],ENT_QUOTES);
  
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

  //sql statement
  $sql = "DELETE FROM post WHERE pid = '".$pid."'";
  //echo $sql;
  mysql_query($sql);
  mysql_close($link);
  Header("location:manage.php");
  exit();
  			
	
?>