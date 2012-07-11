<?PHP
	/******************************
	**	viewaccount.php
	**	elviscat@gmail.com
	**  Elvis Wu
	**  06/03/2009 Wednesday
	**  version2:
	**  05/11/2012 Friday
	**  version3:
	**  0?/??/20?? Tuesday
	**  version3:
	**  ??/??/200? Wednesday?
	*******************************/
	session_start();
	include('template/dbsetup.php');
	include('inc/config.inc.php');
	
	include('template/header0.php');
	
	
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

	$id = htmlspecialchars($_GET['id'],ENT_QUOTES);
	$taxon_name = $_GET['taxon_name'];
	$level = htmlspecialchars($_GET['lv'],ENT_QUOTES);
	$sql = '';
	
	if( isset($id) && $id != ""){
		$level = 'species';
		$sql = "SELECT * FROM biglonglist WHERE bid = '".$id."'";
	}else if (isset($taxon_name) && $taxon_name != "" && isset($level) && $level != ""){
		if( $level == "family"){
			$sql = "SELECT distinct(mgenus) FROM biglonglist WHERE mfamily = '".$taxon_name."'";
		}else if($level == "genus"){
			$sql = "SELECT distinct(mspecies) FROM biglonglist WHERE mgenus = '".$taxon_name."'";
		}else if($level == "species"){
			$taxon_name_array = explode(" ", $taxon_name);
			$sql = "SELECT * FROM biglonglist WHERE mgenus = '".$taxon_name_array[0]."' AND mspecies ='".$taxon_name_array[1]."'";
		}
	}else{
		echo "This is not a illegal access!";
		exit();
	}
	//echo "\$sql is :: ".$sql."<BR />\n";
	
function docs_list_from_taxon_name($taxon_name){
	$sql_doc_list = "SELECT * FROM cc_doc WHERE taxon_name = '".$taxon_name."'";
	//echo "\$sql_doc_list is :: ".$sql_doc_list."<BR />\n";
	$result_doc_list = mysql_query ($sql_doc_list) or die ("Invalid query :: doc_list");
	if(mysql_num_rows($result_doc_list) > 0){
		//echo "<h3>".$caption."</h3>";
		echo "<table>\n";
		echo "<tr>\n";
		echo "<th align=\"left\">Taxon</td>\n";
		echo "<th align=\"left\">Level</td>\n";
		echo "<th align=\"left\">Title</td>\n";
		echo "<th align=\"center\">State</td>\n";
		echo "<th align=\"center\">Decision</td>\n";
		echo "</tr>\n";				
		while ( $nb_doc_list = mysql_fetch_array($result_doc_list) ) {
			echo "<tr bgcolor=\"#FDDC99\">";
			echo "<td align=\"left\"><a href=\"viewdoc.php?docid=".$nb_doc_list['docid']."\"><i>".$nb_doc_list['taxon_name']."</i></a></td>";
			echo "<td align=\"left\">".$nb_doc_list['lv']."</td>";
			echo "<td align=\"left\">".$nb_doc_list['title']."</td>";
			echo "<td align=\"left\">".doc_state($nb_doc_list['state'])."</td>";
			echo "<td align=\"left\">".doc_decision($nb_doc_list['decision'])."</td>";
		}
		echo "</table>";
  	}else{
		echo "<p>Now there is no any documents here.</p>\n"; //Invalid Login
	}
}
	
	
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

<title>Taxon Profiles View Profile</title>
	<script type="text/javascript" src="jquery/jquery-1.3.2.js"></script>
	<!--<script type="text/javascript" src="jquery/jquery.form.js"></script>-->
	<script>
	/*
	function test1() {
		history.back(1);
	}
	$(document).ready(function(e){
		$('#myForm').ajaxForm(test1);	
	});
	*/
	</script>
</head>
<body>
<!-- wrap starts here -->
<div id="wrap">
		
	<!--header -->
    <?php
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
		<div id="main">
			<form id="addDocFromTaxonForm" action="docadd.php" method="post">
              <?php
				
				echo "<h3>Taxon Profile: ".""."</h3>";
				if($level == "family"){
					echo "<p><b>Family: ".$taxon_name." and genera belonging to this family is listed as follows:</b></p>\n";
				}else if($level == "genus"){
					echo "<p><b>Genus: ".$taxon_name." and species belonging to this genus is listed as follows:</b></p>\n";
				}
				echo "<table>";
				
				$result = mysql_query($sql);
				if(mysql_num_rows($result) > 0){
					//echo $sql;
					$sid =0;
					//while ($nb=mysql_fetch_array($result)) {
					//	$sid +=1;
					//}    
					//echo "<p>There are ".$sid." results.</p>";

					//echo "<tr>";
					//echo "<td align=\"center\">Column Name</td>";
					//echo "<td align=\"center\">Description</td>";
					//echo "</tr>";
					echo "<tr bgcolor=\"#FDDC99\">";
					echo "<td align=\"left\">";
					while ($nb = mysql_fetch_array($result)) {
						if($level == "family"){
							
							$sql_distinct_genus = "SELECT distinct(mgenus) FROM biglonglist WHERE mfamily = '".$taxon_name."' AND mgenus ='".$nb['mgenus']."'";
							//echo "\$sql_distinct_genus is :: ".$sql_distinct_genus."<BR />\n";
							$result_distinct_genus = mysql_query($sql_distinct_genus);
							if(mysql_num_rows($result_distinct_genus) > 0){
								while ($nb_distinct_genus = mysql_fetch_array($result_distinct_genus)) {
									//echo "<h3>".$nb_distinct_genus['mgenus']."</h3>\n";
									echo "<a href=\"viewtaxon.php?lv=genus&taxon_name=".$nb_distinct_genus['mgenus']."\">".$nb_distinct_genus['mgenus']."</a> ";
								}
							}
						}else if($level == "genus"){
							$sql_sci_name = "SELECT * FROM biglonglist WHERE mgenus = '".$taxon_name."' AND mspecies ='".$nb['mspecies']."'";
							//echo "\$sql_sci_name is :: ".$sql_sci_name."<BR />\n";
							$result_sci_name = mysql_query($sql_sci_name);
							if(mysql_num_rows($result_sci_name) > 0){
								while ($nb_sci_name = mysql_fetch_array($result_sci_name)) {
									echo "<i><a href=\"viewtaxon.php?id=".$nb_sci_name['bid']."\">".$nb_sci_name['mgenus']." ".$nb_sci_name['mspecies']."</a></i><BR />\n";
								}
							}
						}else if($level == "species"){
							$taxon_name = $nb['mgenus']." ".$nb['mspecies'];
							echo "<h3>".$nb['mfamily']."</h3>\n";
							echo "<h3><i>".$nb['mgenus']." ".$nb['mspecies']."</i> ".$nb['mauthor']."</h3>\n";
							//mtypelocal 	mccode 	mpaese
							echo "<b>".$nb['mtypelocal']."</b><BR />\n";
							echo "<b>".$nb['mtcode']."</b><BR />\n";
							echo "<b>".$nb['mpaese']."</b><BR />\n";
							/*
							echo "<td align=\"center\">Family Name</td>";
							echo "<td align=\"center\">".$nb[1]."</td>";
	                  		echo "</tr>";
	                  		echo "<tr bgcolor=\"#FDDC99\">";
	                  		echo "<td align=\"center\">Genus Name</td>";
	                  		echo "<td align=\"center\"><i>".$nb[2]."</i></td>";
	                  		echo "</tr>";
	                  		echo "<tr bgcolor=\"#FDDC99\">";
	                  		echo "<td align=\"center\">Species Name</td>";
	                  		echo "<td align=\"center\"><i>".$nb[3]."</i></td>";
	                  		echo "</tr>";
	                  		echo "<tr bgcolor=\"#FDDC99\">";
	                  		echo "<td align=\"center\">Author Information</td>";
	                  		echo "<td align=\"center\"><i>".$nb[4]."</i></td>";
	                  		echo "</tr>";
	                  		echo "<tr bgcolor=\"#FDDC99\">";
	                  		echo "<td align=\"center\">Type Locality</td>";
	                  		echo "<td align=\"center\"><i>".$nb[5]."</i></td>";
	                  		echo "</tr>";
	                  		echo "<tr bgcolor=\"#FDDC99\">";
	                  		echo "<td align=\"center\">C_Code</td>";
	                  		echo "<td align=\"center\"><i>".$nb[6]."</i></td>";
	                  		echo "</tr>";
	                  		echo "<tr bgcolor=\"#FDDC99\">";
	                  		echo "<td align=\"center\">Paese</td>";
	                  		echo "<td align=\"center\"><i>".$nb[7]."</i></td>";
	                  		*/
						}
						
					}
					echo "</td>";
					echo "</tr>";
				}else{
					echo "<h3>There is no match result.</h3>"; //Invalid Login
				}
				echo "</table>";
				
				
				$request_uri_array = explode("/", $_SERVER['REQUEST_URI']);
				$request_uri_2 = $request_uri_array[sizeof($request_uri_array)-1];
				if($_GET['expand_docs'] == 'yes'){
					//echo "HELLO!!";
					//$_SERVER['REQUEST_URI'] --> /~hwu5/fishanatomy/view.php?taxon_id=1
					//echo $request_uri_2;
					$target_uri = str_replace("yes", "no", $request_uri_2);
					echo "<p><a href=\"".$target_uri."\"><img src=\"./images/collapse.png\" width=\"16\" height=\"16\" border=\"1\"></a></p>";
					docs_list_from_taxon_name($taxon_name);
				}else{
					$is_contain = eregi('&expand_docs=no',$request_uri_2)? '0' : '1';
					if($is_contain == '0'){
						//echo "There is a '&expand_docs=no' here!";
						$target_uri = str_replace("no", "yes", $request_uri_2);
					}else{
						//echo "There is no '&expand_docs=no' here!";
						$target_uri = $request_uri_2."&expand_docs=yes";
					}
					echo "<p><a href=\"".$target_uri."\"><img src=\"./images/expand.png\" width=\"16\" height=\"16\" border=\"1\"></a></p>";
				}
				
				
                mysql_close($link);
                echo "</p>";
              ?>
				<input type="hidden" id="level" name="level" value="<?PHP echo $level; ?>" />
				<input type="hidden" id="taxon_name" name="taxon_name" value="<?PHP echo $taxon_name; ?>" />
				<input type="hidden" id="doc_type" name="doc_type" value="author" />
				<?php
					if($_SESSION['role'] != "admin"){
						echo "<input class=\"button\" type=\"submit\" value=\"Add a document to this taxon profile\" />";
					}
				?>
			</form>
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
