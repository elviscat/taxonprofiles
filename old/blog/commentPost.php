<?php
  //Developed by elviscat (elviscat@gmail.com)
  //March 13, 2009 Friday::edit the current comment entry
  // ./ current directory
  // ../ up level directory
  $crefpid = htmlspecialchars($_POST['crefpid'],ENT_QUOTES);
  $ctitle = htmlspecialchars($_POST['ctitle'],ENT_QUOTES);
  $ccontent = htmlspecialchars($_POST['ccontent'],ENT_QUOTES);
  $cname = htmlspecialchars($_POST['cname'],ENT_QUOTES);
  $cwebsite = htmlspecialchars($_POST['cwebsite'],ENT_QUOTES);
  $cmsn = htmlspecialchars($_POST['cmsn'],ENT_QUOTES);  

  
  include('../template/dbsetup.php');
  //Connect to database
  $link = mysql_connect($host , $dbuser ,$dbpasswd); 
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  //select database
  mysql_select_db($dbname);
  
  $maxCid = 0;
  $maxCidSql = "SELECT MAX(cid) FROM comment";
  $result = mysql_query ($maxCidSql) or die ("Invalid query");
  if( mysql_num_rows( $result) > 0 ){
	  while ( $nb = mysql_fetch_array($result)) {
		  $maxCid = $nb[0] + 1;
		  //echo "maxPid is ".$maxPid."<br>";
	  }
  }else{
    $maxPid = 1;
  }
  //echo "maxLid is ".$maxPid."<br>";
  $date = date("Y-m-d H:i:s");//"2008-08-28 11:03:21"


  //sql statement
  $sql = "INSERT INTO comment (`cid`, `ctitle`, `ccontent`, `ccredate`, `crefpid`, `cname`, `cwebsite`, `cmsn`) VALUES ";
  $sql .= "('".$maxCid."', '".$ctitle."', '".$ccontent."', '".$date."', '".$crefpid."', '".$cname."', '".$cwebsite."', '".$cmsn."')";
  //echo $sql;
  mysql_query($sql);
  mysql_close($link);
  
  
  Header("location:detail.php?pid=".$crefpid."");
  exit();
  			
?>