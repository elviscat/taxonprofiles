<?
/******************************
**	authoraccountadd.php
**	elviscat@gmail.com
**  Elvis Wu
**  09/15/2008
**  version2:
**  09/16/2008
*******************************/
session_start();
include('template/dbsetup.php');
?>
<?
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}
//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);
//now validating the username and password
$sql = "SELECT contri4 FROM user WHERE username = '".$_SESSION['username']."'";
$result=mysql_query($sql);
$row = mysql_fetch_row($result);
$wtt;//delclare the variable "willingtotaxon"

if(mysql_num_rows($result)>0){
	$wtt = $row[0];	
}else{
	//"<p>There is no match result.</p>"; //Invalid Login
}
//echo "wtt is :".$wtt;
if($wtt == '0'){
	Header("location:nowilltocontri.php");
	exit();
}
if($_GET['ccdocowner'] != $_SESSION['username']){
	Header("location:error.php");
	exit();
}


?>
<?
include('template/header0.php');
?>
<!--Replaced by header0.php-->
<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta name="Description" content="cypriniformes, species information" />
<meta name="Keywords" content="cypriniformes, species information" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Richard Mayden - cypriniformes@gmail.com" />
<meta name="Robots" content="index,follow" />
-->

<link rel="stylesheet" href="images/CoolWater.css" type="text/css" />

<title>CypCom Author Account Add</title>


<script src="jquery/jquery.js" type="text/javascript" language="javascript"></script>
<script src="authoraccountadd/authoraccountadd.js" type="text/javascript" language="javascript"></script>
<link rel=stylesheet type="text/css" href="authoraccountadd/authoraccountadd.css">


</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
	<!--header -->
    <?
	include('template/header.php')
	?>
    <!--Replaced by header.php -->
	<!--
    <div id="header">			
				
		<h1 id="logo-text"><a href="index.html">Cypriniformes Commons</a></h1>		
		<p id="slogan">BETA</p>		
			
		<div id="header-links">
			<p>
			<a href="index.html">Home</a> | 
			<a href="recommendation.html">Recommendations</a> | 
			<?
			/* 
			if($_SESSION['is_login']==true){
				echo "<a href=\"logout.php\">Logout</a>";
			}else{
				echo "<a href=\"login.php\">Login</a>";
			}
			*/
			
            //Original Setting
            //<a href="login.html">Login</a>
            //Original Setting		
			?>
            </p>		
		</div>		
						
	</div>
	-->
    <?
	include('template/menu.php')
	?>
    <!--Replaced by menu.php -->	
	<!-- navigation -->	
	<!--
    <div  id="menu">
		<ul>
			<li id="current"><a href="index.html">Home</a></li>
			<li><a href="blog.html">Taxonomic Blog</a></li>
			<li><a href="search.html">Search Species</a></li>
			<li><a href="updatetotaxa.html">Update to Taxa</a></li>
			<li><a href="index.html">About Us</a></li>		
		</ul>
	</div>					
	-->
    		
	<!-- content-wrap starts here -->
	<div id="content-wrap">
<?

?>	
		<div id="main">
<div id="msg"></div>
            <h4>Hi, <font color="blue"><? echo $_SESSION['username'];?></font></h4>
            <h3>Added Result</h3>
<?
$max_ccdocid = 0;
$sql = "SELECT MAX(ccdocid) FROM cc_doc";
$result = mysql_query ($sql) or die ("Invalid query");
if(mysql_num_rows($result)>0){
	while ($nb=mysql_fetch_array($result)) {
		$max_ccdocid = $nb[0]+1;
		//echo "max_ccdocid is ".$max_ccdocid;
	}
}else{
	$max_ccdocid = 1;
	//echo "<p>Error Happens</p>"; //Invalid Login
}
$initime = date("Y-m-d H:i:s");//"2008-08-28 11:03:21"


/**Time Drift*/
$timestamp = time();
//echo strftime( "%Hh%M %A %d %b",$timestamp);
//echo "p";
//echo strftime("%Y-%m-%d %H:%i:%s",$timestamp);

/**Test*/
//echo $initime;
//echo "<BR>";
/**Test*/

$date_time_array = getdate($timestamp);
$hours = $date_time_array["hours"];
$minutes = $date_time_array["minutes"];
$seconds = $date_time_array["seconds"];
$month = $date_time_array["mon"];
$day = $date_time_array["mday"];
$year = $date_time_array["year"];
// 用mktime()函數重新產生Unix時間戳值
// 增加19小時
//$timestamp = mktime($hours + 19, $minutes,$seconds ,$month, $day,$year);
//echo strftime( "%Hh%M %A %d %b",$timestamp);
//echo "br~E after adding 19 hours";
$timestamp = mktime($hours, $minutes,$seconds ,$month, $day + 180,$year);
//echo strftime("%Y-%m-%d %H:%i:%s",$timestamp);

/**Test*/
//echo date("Y-m-d H:i:s",$timestamp);
/**Test*/

/**Time Drift*/
$expirationtime = date("Y-m-d H:i:s",$timestamp);


$sql2 = "SELECT * FROM cc_doc WHERE ccdocowner ='".$_GET['ccdocowner']."' AND ccdoclevel='".$_GET['ccdoclevel']."' AND ccdocname='".$_GET['ccdocname']."' AND ccdoctype='".$_GET['ccdoctype']."'";
$result2 = mysql_query ($sql2) or die ("Invalid query");
if(mysql_num_rows($result2)>0){
	echo "<p>Error Happens</p>"; //Invalid INSERT command, prohibit duplicate insert
}else{
	$sql3 = "INSERT INTO cc_doc (ccdocid,ccdocowner,ccdoclevel,ccdocname,ccdoctype,ccdocinittime,ccdocexpirationtime,ccdocstatus)";
	$sql3 .= " VALUES ('".$max_ccdocid."','".$_GET['ccdocowner']."','".$_GET['ccdoclevel']."','".$_GET['ccdocname']."','".$_GET['ccdoctype']."','".$initime."','".$expirationtime."','proposed')";
	//echo $sql3;
	$result3 = mysql_query ($sql3) or die ("Invalid update query");
	/**Show the data table in ccdoc*/
	$sql4 = "SELECT * FROM cc_doc WHERE ccdocid ='".$max_ccdocid."'";
	$result4 = mysql_query ($sql4) or die ("Invalid query4");
	if(mysql_num_rows($result4)>0){
		//
		//echo "<table width=250>";
		//echo "<tr>";
		//echo "<td align=\"left\">Document ID</td>";
		//echo "<td align=\"left\">Document Owner</td>";
		//echo "<td align=\"center\">Document Level</td>";
		//echo "<td align=\"center\">Document Name</td>";
		//echo "<td align=\"center\">Document Type</td>";
		//echo "<td align=\"center\">Document Initialized Time</td>";
		//echo "<td align=\"center\">Document Expiration Time</td>";
		//echo "<td align=\"center\">Document Status</td>";
		//echo "</tr>";
		//echo "<tr bgcolor=\"#FDDC99\">";
		while ($nb=mysql_fetch_array($result4)) {
			//yes, you can declare it nb again, it is a local variable
			//echo "<td align=\"left\">".$nb[0]."</td>";
			//echo "<td align=\"left\">".$nb[1]."</td>";
			//echo "<td align=\"left\">".$nb[2]."</td>";
			//echo "<td align=\"left\">".$nb[3]."</td>";
			//echo "<td align=\"left\">".$nb[4]."</td>";
			//echo "<td align=\"left\">".$nb[5]."</td>";
			//echo "<td align=\"left\">".$nb[6]."</td>";
			//echo "<td align=\"left\">".$nb[7]."</td>";
			echo "<p>Document ID: ".$nb[0]."<br>";
			echo "Document Owner: ".$nb[1]."<br>";
			echo "Document Level: ".$nb[2]."<br>";
			echo "Document Name: ".$nb[3]."<br>";
			echo "Document Type: ".$nb[4]."<br>";
			echo "Document Initialized Time: ".$nb[5]."<br>";
			echo "Document Expiration Time: ".$nb[6]."<br>";
			echo "Document Status: ".$nb[7]."<br>";
		}
		//echo "</tr>";
		//echo "</table>";
		
		//Use TABLE:cc_meta to generate the customized framework
		//
		$frame_sql = "SELECT DISTINCT(grp_desc) FROM cc_meta WHERE data_type='".$_GET['ccdoclevel']."'";
		//
		$frame_result = mysql_query ($frame_sql) or die ("Invalid query frame_sql");
	    if(mysql_num_rows($frame_result) > 0 ){
			$counter = 0;
			$totalcounter = 0;
			echo "<p>";
			while ( $nb = mysql_fetch_array($frame_result) ) {
				$counter++;
				echo "".$counter.": ".$nb[0]."<BR>";
				$frame_sql2 = "SELECT DISTINCT(subgrp_desc) FROM cc_meta WHERE data_type='".$_GET['ccdoclevel']."' AND grp_desc='".$nb[0]."'";
				//
				$frame_result2 = mysql_query ($frame_sql2) or die ("Invalid query frame_sql2");
	    		if(mysql_num_rows($frame_result2) > 0 ){
					$counter1 = 0;
					while ( $nb2 = mysql_fetch_array($frame_result2) ) {
						$counter1++;
						echo "".$counter."-".$counter1.": ".$nb2[0]."<BR>";
						$frame_sql3 = "SELECT * FROM cc_meta WHERE data_type='".$_GET['ccdoclevel']."' AND grp_desc='".$nb[0]."' AND subgrp_desc='".$nb2[0]."'";
						//
						$frame_result3 = mysql_query ($frame_sql3) or die ("Invalid query frame_sql3");
	    				if(mysql_num_rows($frame_result3) > 0 ){
							$counter2 = 0;
							while ( $nb3 = mysql_fetch_array($frame_result3) ) {
								$counter2++;
								$totalcounter++;
								echo "".$counter."-".$counter1."-".$counter2.": ".$nb3[4]."<BR>";
								//input text
								
								
								//echo "<input name=\"insert".$totalcounter."\" type=\"text\" id=\"insert".$totalcounter."\" value=\"\"/><BR>";
								echo "<textarea name=\"insert".$totalcounter."\" id=\"insert".$totalcounter."\" cols=\"60\" rows=\"2\" ></textarea>";
								echo "<input name=\"insertmeta".$totalcounter."\" type=\"hidden\" id=\"insertmeta".$totalcounter."\" value=\"".$nb3[0]."\"/>";
								//有input text與textarea的差異，怎麼辨別呢?
								
								
								//echo "Detail Description: ".$nb3[0]."<BR>";
							}
						}
					}
				}
			}
			echo "</p>";
			//input text hidden
			echo "<input type=\"hidden\" name=\"totalcounter\" value=\"".$totalcounter."\" />";
			echo "<input type=\"hidden\" name=\"ccdocid\" value=\"".$max_ccdocid."\" />";
		}
		
	}else{
		echo "<p>Error Happens</p>"; //Invalid INSERT command, prohibit duplicate insert
	}
}






?>

<?
	echo "<p>";
	echo "<input class=\"button\" type=\"submit\" value=\"Save\" name=\"Submit\" id=\"submit\" />";
	echo "</p>";
mysql_close($link);
?>            
            <!--				
			<a name="TemplateInfo"></a>
			<h2><a href="index.html">Template Info</a></h2>
					
			<p class="post-by">posted by: <a href="index.html">ealigam</a></p>
				
			<p><strong>CoolWater 1.0</strong> is a free, W3C-compliant, CSS-based website template 
			by <strong><a href="http://www.styleshout.com/">styleshout.com</a></strong>. This work is 
			distributed under the <a rel="license" href="http://creativecommons.org/licenses/by/2.5/">
			Creative Commons Attribution 2.5  License</a>, which means that you are free to 
			use and modify it for any purpose. All I ask is that you include a link back to  
			<a href="http://www.styleshout.com/">my website</a> in your credits.</p>  

			<p>For more free designs, you can visit 
			<a href="http://www.styleshout.com/">my website</a> to see 
			my other works.</p>
		
			<p>Good luck and I hope you find my free templates useful!</p>
				
			<p class="post-footer align-left">					
			<a href="index.html" class="readmore">Read more</a> |
			<a href="index.html" class="comments">Comments (7)</a> |
			<span class="date">Nov 04, 2006</span>	
			</p>
				
			<a name="SampleTags"></a>
			<h2><a href="index.html">Sample Tags</a></h2>
				
			<h3>Code</h3>				
			<p><code>
			code-sample { <br />
			font-weight: bold;<br />
			font-style: italic;<br />				
			}		
			</code></p>	
				
			<h3>Example Lists</h3>
		
			<ol>
				<li>Here is an example</li>
				<li>of an ordered list</li>								
			</ol>	
			<ul>
				<li>Here is an example</li>
				<li>of an unordered list</li>								
			</ul>				
				
			<h3>Blockquote</h3>			
			<blockquote><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy 
			nibh euismod tincidunt ut laoreet dolore magna aliquam erat....</p></blockquote>
				
			<h3>Image and text</h3>
			<p><a href="http://getfirefox.com/"><img src="images/firefox-gray.jpg" width="100" height="120" alt="firefox" class="float-left" /></a>
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
			Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu 
			posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum 
			odio, ac blandit ante orci ut diam. Cras fringilla magna. Phasellus suscipit, leo a pharetra 
			condimentum, lorem tellus eleifend magna, eget fringilla velit magna id neque. Curabitur vel urna. 
			In tristique orci porttitor ipsum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. 				
			</p>
				
			<h3>Table Styling</h3>
					
			<table>
				<tr>
					<th><strong>post</strong> date</th>
					<th>title</th>
					<th>description</th>
				</tr>
				<tr>
					<td>04.18.2007</td>
					<td><a href="index.html">Augue non nibh</a></td>
					<td><a href="index.html">Lobortis commodo metus vestibulum</a></td>
				</tr>
				<tr>
					<td>04.18.2007</td>
					<td><a href="index.html">Fusce ut diam bibendum</a></td>
					<td><a href="index.html">Purus in eget odio in sapien</a></td>
				</tr>
				<tr>
					<td>04.18.2007</td>
					<td><a href="index.html">Maecenas et ipsum</a></td>
					<td><a href="index.html">Adipiscing blandit quisque eros</a></td>
				</tr>
				<tr>
					<td>04.18.2007</td>
					<td><a href="index.html">Sed vestibulum blandit</a></td>
					<td><a href="index.html">Cras lobortis commodo metus lorem</a></td>
				</tr>
			</table>
								
			<h3>Example Form</h3>
			<form method="get" action="#">			
			<p>		
				<label>Name</label>
				<input name="dname" value="Your Name" type="text" size="30" />
				<label>Email</label>
				<input name="demail" value="Your Email" type="text" size="30" />
				<label>Your Comments</label>
				<textarea rows="5" cols="5"></textarea>
				<br />	
				<input class="button" type="reset" />
                <input class="button" type="submit" />		
			</p>		
			</form>	
				
			<br />	
            -->
		</div>
		
		<?
        include('template/sidebar.php');        
		?>	
			
            <!--
			<h2>Search Box</h2>	
			<form action="#" class="searchform">
				<p>
				<input name="search_query" class="textbox" type="text" />
				<input name="search" class="button" value="Search" type="submit" />
				</p>			
			</form>	
					
			<h2>Sidebar Menu</h2>
			<ul class="sidemenu">				
				<li><a href="index.html">Home</a></li>
				<li><a href="#TemplateInfo">Template Info</a></li>
				<li><a href="#SampleTags">Sample Tags</a></li>
				<li><a href="http://www.styleshout.com/">More Free Templates</a></li>	
				<li><a href="http://www.4templates.com/?aff=ealigam">Premium Templates</a></li>	
			</ul>	
				
			<h2>Links</h2>
			<ul class="sidemenu">
				<li><a href="http://www.pdphoto.org/">PDPhoto.org</a></li>
				<li><a href="http://www.squidfingers.com/patterns/">Squidfingers</a></li>
				<li><a href="http://www.alistapart.com">Alistapart</a></li>					
				<li><a href="http://www.cssremix.com">CSS Remix</a></li>
				<li><a href="http://www.cssmania/">CSS Mania</a></li>					
			</ul>
			
			<h2>Sponsors</h2>
			<ul class="sidemenu">
				<li><a href="http://www.4templates.com/?aff=ealigam"><strong>4templates</strong></a> <br /> Low Cost Hi-Quality Templates</li>
				<li><a href="http://store.templatemonster.com?aff=ealigam"><strong>TemplateMonster</strong></a> <br /> Delivering the Best Templates on the Net!</li>
				<li><a href="http://tinyurl.com/3cgv2m"><strong>Text Link Ads</strong></a> <br /> Monetized your website</li>
				<li><a href="http://www.fotolia.com/partner/114283"><strong>Fotolia</strong></a> <br /> Free stock images or from $1</li>
				<li><a href="http://www.dreamstime.com/res338619"><strong>Dreamstime</strong></a> <br /> Lowest Price for High Quality Stock Photos</li>
				<li><a href="http://www.dreamhost.com/r.cgi?287326"><strong>Dreamhost</strong></a> <br /> Premium webhosting</li>
			</ul>
				
			<h2>Wise Words</h2>
				
			<p>&quot;To have a quiet mind is to possess one's mind wholly; to have a calm spirit is to 
			possess one's self.&quot; </p>
					
			<p class="align-right">- Hamilton Mabie</p>
			
			<h2>Support Styleshout</h2>
			<p>If you are interested in supporting my work and would like to contribute, you are
			welcome to make a small donation through the 
			<a href="http://www.styleshout.com/">donate link</a> on my website - it will 
			be a great help and will surely be appreciated.</p>
				
			-->		
		</div>
				
	<!-- content-wrap ends here -->	
	</div>
					
	<!--footer starts here-->
	<?
	include('template/footer.php')
	?>
    <!--Replaced by footer.php -->
    <!--
    <div id="footer">
			
		<p>
		&copy; 2008 <strong>Cypriniformes Commons</strong> | 
		Design by: <a href="http://www.styleshout.com/">styleshout</a> | 
		Valid <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | 
		<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>   		
   	</p>
				
	</div>	
	-->
<!-- wrap ends here -->
</div>

</body>
</html>
