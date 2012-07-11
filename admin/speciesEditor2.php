<?
  //Developed by elviscat
  //March 10, 2009 Tuesday
  //March 12, 2009 Thursday::add external link to record the location and multi-media documents
  // ./ current directory
  // ../ up level directory
  session_start();
  if( (!isset($_SESSION['is_login'])) && ($_SESSION['role'] != "admin") ){
	  Header("location:../error.php");
	  exit();
  }
  include('../template/dbsetup.php'); 

  //get the gettted values
  $sid = htmlspecialchars($_GET['sid'],ENT_QUOTES);
  //echo $sid;
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
  
  
  //sql statement
  $sql = "SELECT * FROM biglonglist WHERE bid = '".$sid."'";
  $result=mysql_query($sql);
  $mfamily ="";
  $mgenus ="";
  $mspecies ="";
  $mauthor = "";
  $mtypelocal = "";
  $mccode = "";
  $mpaese = "";
  //echo "Hello Elvis!";
  //echo $sql;
  //echo "Hello Elvis2!";
  if(mysql_num_rows($result)>0){
    //echo $sql;
    while ($nb=mysql_fetch_array($result)) {
      $bid = $nb[0];
      $mfamily = $nb[1];
      $mgenus = $nb[2];
      $mspecies = $nb[3];
      $mauthor = $nb[4];
      $mtypelocal = $nb[5];
      $mccode = $nb[6];
      $mpaese = $nb[7];
	  }
  }
  mysql_close($link);
  
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
<title>Taxon Profiles Admin Editor 2</title>
<script src="../jquery/jquery.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../jquery/jquery.form.js" />
<script type="text/javascript">
  // wait for the DOM to be loaded 
  $(document).ready(function() { 
    // bind 'speciesEditor' and provide a simple callback function 
    $(#speciesEditor').ajaxSubmit(function() {  
      return false; 
    });        
  });
</script>
<script src="http://www.google.com/jsapi?key=ABQIAAAA53TeMwGJV1oqIQjLa45WyxRwJBcjfig5IcUyn5o--V8jGmjykRT0Jn28cbw124S7zyh4BZFhcW9BNg" type="text/javascript"></script>
    <script language="Javascript" type="text/javascript">
    //<![CDATA[
    google.load("search", "1");
    function OnLoad() {
      // Create a search control
      var searchControl = new google.search.SearchControl();
      // Add in a full set of searchers
      var localSearch = new google.search.LocalSearch();
      //searchControl.addSearcher(localSearch);
      searchControl.addSearcher(new google.search.WebSearch());
      //searchControl.addSearcher(new google.search.VideoSearch());
      //searchControl.addSearcher(new google.search.BlogSearch());
      searchControl.addSearcher(new google.search.ImageSearch());
      // Set the Local Search center point
      localSearch.setCenterPoint("New York, NY");
      // Tell the searcher to draw itself and tell it where to attach
      searchControl.draw(document.getElementById("searchcontrol"));
      // Execute an inital search
      searchControl.execute("<? echo $mgenus." ".$mspecies; ?>");
    }
    google.setOnLoadCallback(OnLoad);
    //]]>
    </script>
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
			<h3>Species Editor</h3>
			<form id="speciesEditor" action="speciesEditor3.php" method="post">		
				<p><h3>You are current editing the species: <? echo "<i>".$mgenus." ".$mspecies."</i>"; ?></h3></p>
        <p>Series Number: <? echo $bid; ?><input name="bid" type="hidden" value="<? echo $bid; ?>" /></p>
        <p>Family Name: <input name="mfamily" type="text" value="<? echo $mfamily; ?>" /></p>
        <p>Genus Name:	<input name="mgenus" type="text" value="<? echo $mgenus; ?>" /></p>
				<p>Species Name: <input name="mspecies" type="text" value="<? echo $mspecies; ?>""/></p>
				<p>Author Information: <input name="mauthor" type="text" value="<? echo $mauthor; ?>""/></p>
        <p>Type Locality: <input name="mtypelocal" type="text" value="<? echo $mtypelocal; ?>""/></p>
        <p>Ccode: <input name="mccode" type="text" value="<? echo $mccode; ?>""/></p>
				<p>Paese: <input name="mpaese" type="text" value="<? echo $mpaese; ?>""/></p>
        <p><input type="submit" value="Update this information" /></p>
			</form>			
			
			<h3>Additional editor</h3>
      <form method="post" action="" id="addtionalEditor">
        <p><a href="multimediaManage.php?bid=<? echo $bid; ?>">Manage your multimedia data</a></p>
        <p><a href="fileupload.php?bid=<? echo $bid; ?>">Upload your multimedia data</a></p>
			  <p><a href="geocodingManage.php?bid=<? echo $bid; ?>">Manage your location data</a></p>
        <p><a href="geocoding.php?bid=<? echo $bid; ?>">Add your location data</a></p>
      </form>
      <form method="post" action="" id="addtionalEditor">
        <p><a href="admin.php">Back to admin main page</a></p>
      </form>
      <form method="post" action="" id="addtionalEditor">
        <p><div id="searchcontrol" class=table>Loading...</div></p>
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
