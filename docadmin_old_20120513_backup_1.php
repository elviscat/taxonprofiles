<?
/******************************
**	docdmin.php
**	elviscat@gmail.com
**  Elvis Wu
**  05/27/2009 Wednesday
**  version2:
**  05/27/2009 Wednesday
**  version3:
**  05/27/2009 Wednesday
**  version4:
**  05/11/2012 Friday
*******************************/
session_start();
include('template/dbsetup.php');
include('inc/config.inc.php');
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


mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


$doc_type = $_GET['doc_type'];


/*
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
*/
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

<title>Taxon Profiles Document Admin</title>
<script src="jquery/jquery.js" type="text/javascript" language="javascript"></script>
<link rel=stylesheet type="text/css" href="docadmin/docadmin.css">
<script>  
function runFunction(e){
  document.location = 'useradmin.php';
}
$(document).ready(function(e){
  $('#submit').click(runFunction);
});

</script>
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
            <p>Hi <font color="blue"><?PHP echo $_SESSION['username']." (".$_SESSION['name']."),"; ?></font></p>
            <h2>Your Document List as the type of <? echo $_GET['doc_type']; ?></h2>

<?php

/*
function table_render($name, $account_level){
  $sql = "SELECT * FROM account_author_reviewer WHERE acclevel ='".$account_level."' AND acctype = '".$_GET[doc_level]."' and accowner='".$_SESSION['username']."'";
  //echo $sql;
  $result = mysql_query ($sql) or die ("Invalid query");
  if(mysql_num_rows($result)>0){
    $sid =0;
	  //while ($nb=mysql_fetch_array($result)) {
	  //	$sid +=1;
	  //}    
	  //echo "<p>There are ".$sid." results.</p>";
	  echo "<h3>".$name."</h3>";
    echo "<table>";
	  echo "<tr>";
	  echo "<td align=\"left\">Name</td>";
	  echo "<td align=\"left\">Status</td>";
	  echo "<td align=\"center\">Go to Edit it</td>";
	  echo "</tr>";
	  while ($nb=mysql_fetch_array($result)) {
	 	  echo "<tr bgcolor=\"#FDDC99\">";
		  echo "<td align=\"left\">".$nb[4]."</td>";
		  //去TABLE:cc_doc找是否有符合這一個的相關資料
		  $sub_sql = "SELECT * FROM cc_doc WHERE ccdocowner ='".$nb[1]."' AND ccdoclevel='".$nb[2]."' AND ccdoclevelname ='".$nb[3]."' AND ccdocname='".$nb[4]."' AND ccdoctype='".$nb[5]."'";
		  //echo $sub_sql;
		  $sub_result = mysql_query ($sub_sql) or die ("Invalid query");
		  if(mysql_num_rows($sub_result)>0){
			  while ($sub_nb=mysql_fetch_array($sub_result)) {
				  echo "<td align=\"left\">".$sub_nb[8]."</td>";//Status
				  //echo "<td align=\"left\"><a href=\"accountedit.php?ccodocid=".$sub_nb[0]."\">Edit</a></td>";
				  if( $sub_nb[8] == "under_reviewing" ){
            echo "<td align=\"left\">Wait for decision</td>";
          }else{
            echo "<td align=\"left\"><a href=\"docedit.php?ccdocid=".$sub_nb[0]."&ccdoclevel=".$nb[2]."&ccdoctype=".$nb[5]."\">Edit</a></td>";
			    }
        }
		  }else{
			  echo "<td align=\"left\">No entry</td>";
			  echo "<td align=\"left\">No entry, <a href=\"docadd.php?ccdocowner=".$nb[1]."&ccdoclevel=".$nb[2]."&ccdoclevelname=".$nb[3]."&ccdocname=".$nb[4]."&ccdoctype=".$nb[5]."\">add</a></td>";
		  }
		  //尚未增加：過期或是已經published都不能再修改
		  echo "</tr>";
	  }
	  echo "</table>";
  }else{
	  echo "<p>Now there is no any record here.</p><p><a href=\"accountadmin.php\">Go to Here to Add</a></p>"; //Invalid Login
  }
}
*/

	
	$sql_lv = "SELECT DISTINCT(lv) FROM cc_doc WHERE doc_type ='".$doc_type."'";
	//echo "\$sql_lv is :: ".$sql_lv."<BR />\n";
	$result_lv = mysql_query ($sql_lv) or die ("Invalid query :: sql_lv");
	if( mysql_num_rows($result_lv) > 0 ){
		while ( $nb_lv = mysql_fetch_array($result_lv) ) {
			$lv = $nb_lv[0];
			echo "<h3>".$lv."</h3>";
			$sql_doc_list = "SELECT * FROM cc_doc WHERE ref_uid = '".$_SESSION['uid']."' AND lv = '".$lv."' AND doc_type ='".$doc_type."'";
			//echo "\$sql_doc_list is :: ".$sql_doc_list."<BR />\n";
			$result_doc_list = mysql_query ($sql_doc_list) or die ("Invalid query :: sql_doc_list");
			if( mysql_num_rows($result_doc_list) > 0 ){
				echo "<table>\n";
				echo "<tr>\n";
				echo "<th align=\"left\">Taxon</td>\n";
				echo "<th align=\"left\">Title</td>\n";
				echo "<th align=\"center\">State</td>\n";
				echo "<th align=\"center\">Decision</td>\n";
				echo "<th align=\"center\">Edit</td>\n";
				echo "</tr>\n";				
				while ( $nb_doc_list = mysql_fetch_array($result_doc_list) ) {
					echo "<tr bgcolor=\"#FDDC99\">";
					echo "<td align=\"left\">".$nb_doc_list['taxon_name']."</td>";
					echo "<td align=\"left\">".$nb_doc_list['title']."</td>";
					echo "<td align=\"left\">".doc_state($nb_doc_list['state'])."</td>";
					echo "<td align=\"left\">".doc_decision($nb_doc_list['decision'])."</td>";
					if( $sub_nb_doc_list['state'] == "1" ){
						echo "<td align=\"left\"> - - </td>";
					}else{
						echo "<td align=\"left\"><a href=\"docedit.php?docid=".$nb_doc_list['docid']."\">Edit</a></td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}
		}
	}else{
		echo "<p>Now there is no any record here.</p>"; //Invalid Login
		//echo "<p>Now there is no any record here.</p><p><a href=\"accountadmin.php\">Go to Here to Add</a></p>"; //Invalid Login
	}



//table_render("Family", "family");
//table_render("Genus", "genus");
//table_render("Species", "species");

	echo "<p>";
	echo "<input class=\"button\" type=\"submit\" value=\"Back to admin\" name=\"Submit\" id=\"submit\" />";
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
