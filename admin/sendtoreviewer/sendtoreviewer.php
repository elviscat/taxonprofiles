<?php 
/******************************
**	sendtoreviewer.php::
**	elviscat@gmail.com
**  Elvis Hsin-Hui Wu
**  06/09/2009 Tuesday
**  version2:
**  0?/??/200? Monday?
**  version3:
**  0?/??/200? Thursday?
*******************************/
session_start();
require_once('../../inc/config.inc.php'); // Get the config information

include('../../template/dbsetup.php');

require('../../phpmailer/class.phpmailer.php');

$queryString = htmlspecialchars($_POST['queryString'],ENT_QUOTES);
$queryStringArray = explode("&amp;", $queryString);
$reviewer = "";
$message;
$taxon_name;
for ($i =0 ; $i < sizeof($queryStringArray); $i++){
  //echo "queryStringArray[".$i."] is ".$queryStringArray[$i]."\n<br>";
  $queryStringArray2 = explode("=", $queryStringArray[$i]);
  if($queryStringArray2[0] == 'reviewer'){
    $reviewer .= $queryStringArray2[1].";";
  }
  if($queryStringArray2[0] == 'message'){
    $message = $queryStringArray2[1];
    $message = str_replace('%2C', ',', $message);
    $message = str_replace('%3C', '<', $message);
    $message = str_replace('%3E', '>', $message);
    $message = str_replace('+', ' ', $message);
    $message = str_replace('%3A', ':', $message);
    $message = str_replace('%2F', '/', $message);
  } 
  if($queryStringArray2[0] == 'taxon_name'){
    $taxon_name = $queryStringArray2[1];
    $taxon_name = str_replace('+', ' ', $taxon_name);
  } 
  /*
  for ($j =0 ; $j < sizeof($queryStringArray2); $j++){
    echo "queryStringArray2[".$j."] is ".$queryStringArray2[$j]."\n<br>";
  }
  */
}

//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
  die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);

if( strlen($reviewer) == 0){
  echo "You need to select at least one reviewer!";
}else{
  //echo $reviewer;
  $reviewerArray = explode(";", $reviewer);
  for ($i =0 ; $i < (sizeof($reviewerArray)-1); $i++){
    //echo "reviewerArray[".$i."] is ".$reviewerArray[$i]." and message is ::".$message."\n<br>";
    $sql = "SELECT name, eml FROM user WHERE username ='".$reviewerArray[$i]."'";
    //echo "sql is ::".$sql;
    $result = mysql_query ($sql) or die ("Invalid query for sql");
    if(mysql_num_rows($result)>0){
      while ($nb = mysql_fetch_array($result)) {
        $reviewer_name = $nb[0];
        $eml = $nb[1];
        $name = "Cypriniformes Commons System Administrator";
        //echo "Email is ::".$nb[0]."<br>";
        //Send email to reviewer!!
        //
        //get????
        $serverhostname = getenv('SERVER_NAME');
        //check the email address is valid or not
        
        $mail = new PHPMailer();
        $mail->IsSMTP(); // send via SMTP
        $mail->Host = "slumailrelay.slu.edu"; // SMTP servers
        $mail->SMTPAuth = false; // turn on SMTP authentication
        $mail->Username = ""; // SMTP username
        $mail->Password = ""; // SMTP password
        $mail->From = $admin_email;
        $mail->FromName = $name;
        // ?? $mail->AddAddress() ?????,???????
        $mail->AddAddress($eml);
        //$mail->AddAddress("elviscat@gmail.com","elviscat2@gmail.com"); // optional name
        $mail->AddReplyTo($admin_email,$name);
        $mail->WordWrap = 50; // set word wrap
        // ?? $mail->AddAttachment() ????,??????
        //$mail->AddAttachment("path_to/file"); // attachment
        //$mail->AddAttachment("path_to_file2", "INF");
        // ????,????? HTML ?????
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = "Informs for review from ".$name;
        //$mail->Body = "This is the <b>HTML body</b>";
        $mail->Body = "Dear ".$reviewer_name.",<br>";
        $mail->Body .= "You are selected to be the reviewer fot this taxon: <B>".$taxon_name."</B>.<br>";
        $mail->Body .= "Please go to your reviewer page for this taxon for review<br>";
        $mail->Body .= $message.".<br>";
        $mail->Body .= "With Regards,<br>";
        $mail->Body .= $name;
        $mail->AltBody = "This is the text-only body";
        echo "<p>\n";
        if(!$mail->Send()){
          echo "Email is not sent.";
          //echo "Mailer Error: " . $mail->ErrorInfo;
          //exit;
        }else{
          echo "Email has been sent.";
        }
      //End of email function
      }
    }
  }  
}



/*
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
  echo "<td align=\"center\">Family Name</td>";
  echo "<td align=\"center\">Genus Name</td>";
  echo "<td align=\"center\">Species Name</td>";
  //echo "<td align=\"center\">Holder</td>";
  while ($nb2=mysql_fetch_array($result)) {
    echo "<tr bgcolor=\"#FDDC99\">";
	echo "<td align=\"center\">".$nb2[1]."</td>";
	echo "<td align=\"center\"><i>".$nb2[2]."</i></td>";
	echo "<td align=\"center\"><a href=\"viewaccount.php?id=".$nb2[0]."\"><i>".$nb2[3]."</i></a></td>";
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
*/
?>
