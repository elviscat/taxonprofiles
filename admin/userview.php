<?
/******************************
**	userview.php::
**	elviscat@gmail.com
**  Elvis Hsin-Hui Wu
**  06/09/2009 Tuesday
**  version2:
**  0?/??/200? Monday?
**  version3:
**  0?/??/200? Thursday?
*******************************/
session_start();
include('../template/dbsetup.php');
?>
<?
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}
if(!isset($_SESSION['role']) == "admin"){
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
?>
<?
include('../template/header0.php');
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
<link rel="stylesheet" href="../images/CoolWater.css" type="text/css" />
<title>CypCom Review Panel</title>
<script src="jquery/jquery.js" type="text/javascript" language="javascript"></script>

</head>
<body>
<!-- wrap starts here -->
<div id="wrap">
  <!--header -->
  <?
	include('../template/header.php')
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
	include('../template/menu.php')
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
    <div id="main">
      <p>Hi, <font color="blue"><? echo $_SESSION['name'];?></font>. Welcome to user information panel! In this page, administrator can review the user information.</p>
<?
//$username = htmlspecialchars($_GET['username'],ENT_QUOTES);
//$username = $_GET['username'];
//echo "GET username is ".$_GET['username'];

function table_render($title, $username){
  $sql = "SELECT * FROM user WHERE username ='".$username."'";
  //echo "sql is ::".$sql;
  $result = mysql_query ($sql) or die ("Invalid query");
  if(mysql_num_rows($result)>0){
    //$sid =0;
	  //while ($nb=mysql_fetch_array($result)) {
	  //	$sid +=1;
	  //}    
	  //echo "<p>There are ".$sid." results.</p>";
	echo "<h3>".$title."</h3>";
    echo "<table width=\"500\">";
	  echo "<tr>";
	  echo "<td align=\"center\">Infor Item</td>";
	  echo "<td align=\"center\">Desc</td>";
	  echo "</tr>";
	  while ($nb=mysql_fetch_array($result)) {
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Actual Name</td>";
	    echo "<td align=\"center\">".$nb[3]."</td>";
	    echo "</tr>";
	    echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Address</td>";
	    echo "<td align=\"center\">".$nb[4]."</td>";
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Telphone Number</td>";
	    echo "<td align=\"center\">".$nb[5]."</td>";
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Fax Number</td>";
	    echo "<td align=\"center\">".$nb[6]."</td>";
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Email</td>";
	    echo "<td align=\"center\">".$nb[7]."</td>";
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Web Address</td>";
	    echo "<td align=\"center\">".$nb[8]."</td>";
	    echo "</tr>";	    
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Cypriniformes Group</td>";
	    echo "<td align=\"center\">".$nb[10]."</td>";
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Research Interest</td>";
	    echo "<td align=\"center\">".$nb[11]."</td>";
	    echo "</tr>";	    
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Hobby Interest</td>";
	    echo "<td align=\"center\">".$nb[12]."</td>";
	    echo "</tr>";
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Region</td>";
	    echo "<td align=\"center\">".$nb[13]."</td>";
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Education</td>";
	    echo "<td align=\"center\">".$nb[14]."</td>";
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">field Of Study</td>";
	    echo "<td align=\"center\">".$nb[15]."</td>";
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Activate Level</td>";
	    echo "<td align=\"center\">".$nb[16]."</td>";
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Role</td>";
	    echo "<td align=\"center\">".$nb[17]."</td>";
	    echo "</tr>";	    
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Willing for contribution</td>";
	    echo "<td align=\"center\">".$nb[18]."</td>";
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Are you interested in any exchange of live Cypriniformes species for hobby?</td>";
	    if( $nb[19] == 1){
        echo "<td align=\"center\">Yes</td>";
	    }else{
        echo "<td align=\"center\">No</td>";
      }
	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Are you interested in joining a research group on Cypriniformes?</td>";
	    if( $nb[20] == 1){
        echo "<td align=\"center\">Yes</td>";
	    }else{
        echo "<td align=\"center\">No</td>";
      }	    echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Do you have photographs of live species of Cypriniformes that you would be willing to contribute to an upcoming book on the Biology of Cypriniformes?</td>";
	    //
	    //
      echo "<td align=\"center\">".$nb[21]."</td>";
	    //
	    //
      echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Are you willing to serve as an editor for a taxon?</td>";
	    if( $nb[22] == 1){
        echo "<td align=\"center\">Yes</td>";
	    }else{
        echo "<td align=\"center\">No</td>";
      }
	    
      echo "</tr>";
      echo "<tr bgcolor=\"#FDDC99\">";
	    echo "<td align=\"center\">Register Time</td>";
	    echo "<td align=\"center\">".$nb[23]."</td>";
	    echo "</tr>";                        	    
	  }
	  echo "</table>";
  }else{
	  echo "<p>Now there is no any record here.</p><p><a href=\"accountadmin.php\">Go to Here to Add</a></p>"; //Invalid Login
  }
}

table_render("User Information", $_GET['username']);


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
        include('../template/sidebar.php');        
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
	include('../template/footer.php')
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