<?
?>
		<div id="sidebar">
			<h2>Navigation</h2>
			<ul class="sidemenu">				
				<li><a href="index.php">Home</a></li>
				<li><a href="admin.php">Admin</a></li>
				<!--
        <li><a href="index.php">Temp3</a></li>
				<li><a href="index.php">Temp4</a></li>	
				<li><a href="index.php">Temp5</a></li>
        -->	
			</ul>	
				
			<h2>Recent Promotive Changes</h2>
			<ul class="sidemenu">

        <?php
          //Code is here!
          //Write the code to dynamic select the pictures
          //Connect to database
          $link = mysql_connect($host , $dbuser ,$dbpasswd); 
          if (!$link) {
   	        die('Could not connect: ' . mysql_error());
          }
          //select database
          mysql_select_db($dbname);
           
          $sql = "SELECT * FROM cc_doc WHERE ccdocstatus = 'proposed' OR ccdocstatus = 'initialized' AND ccdoctype='author'";
				  //echo "sql is :: ".$sql."<BR>\n";
   				$result = mysql_query ($sql) or die ("Invalid query");
          if(mysql_num_rows($result) > 0 ){
            while ( $nb = mysql_fetch_array($result) ) {
              //echo "<li><a href=\"viewdoc.php?ccdocid=".$nb[0]."\">".$nb[3]."(author:".$nb[1].",level:".$nb[2].")</a></li>";
              echo "<li><a href=\"viewdoc.php?ccdocid=".$nb[0]."\">".$nb[3]."(".$nb[2].")</a></li>";
            }
          }          
          //Code is here!
        
        
        ?>
        <!--
				<li><a href="recentchangeslist.php">List1</a></li>
				<li><a href="recentchangeslist2.php">List2</a></li>
        -->
			</ul>
<?
?>