<?
/******************************
**	recommendation.php
**	elviscat@gmail.com
**  Elvis Hsin-Hui Wu
**  06/03/2009 Wednesday
**  version2:
**  ??/??/200? Wednesday?
**  version3:
**  ??/??/200? Wednesday?
*******************************/
// ./是這一層目錄
// ../是上一層目錄
session_start();

require_once('inc/config.inc.php'); // Get the config information

include('template/dbsetup.php');
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

<title>Taxon Profiles Report Testing</title>
<script type="text/javascript" src="jquery/jquery-1.3.2.js"></script>
<script type="text/javascript" src="jquery/jquery.form.js"></script>
<script>
function action() {
  var queryString = $('#myForm').formSerialize();  
  $.post("report_testing/email.php",
  {queryString:queryString},
	function(data){//do something wiht AJAX
	  //alert(data);
	  //$('#msg').html('<h1>'+data+'</h1>');
	  $('#msg').html(data);
	  //$('#msg').fadeIn();
	});
}
$(document).ready(function(e){
  $('#myForm').ajaxForm(action);	
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
		<div id="main">
		<?php
			//echo $_GET['page_name']."<BR />\n";
		?>
		<?php
			$request_uri_array = explode("/", $_SERVER["REQUEST_URI"]);
			$page_name = $request_uri_array[sizeof($request_uri_array)-1];
			//echo "\$page_name is :: ".$page_name."<BR />\n";
			$page_name = str_replace("report_testing.php?page_name=", '', $page_name);
			//echo "\$page_name2 is :: ".$page_name."<BR />\n";
			
		?>		
<h3>Report Testing Suggestions</h3>
<p>Report Bugs, Comments and Suggestions during Testing to Developer</p>
	<form id="myForm" action=# method="post">
    <p>Please type your name:
    <input id="name" name="name" type="text" size="60" /></p>
	<p>Type Bugs, Comments and Suggestions Here: <textarea name="report_testing"></textarea></p>
    <input id="page_name" name="page_name" type="hidden" value="<?php echo $page_name; ?>" />
    <p><input class="button" type="submit" value="Submit" /></p>
	</form>
	<br />
	<div id="msg"></div>
	<!--<h1>Output Div (#output1):</h1>
	<div id="output1">AJAX response will replace this content.</div>-->

	<!--
                <form id="myForm1" action=# method="post"><div>
                        <input type="hidden" name="Hidden" value="hiddenValue" />
                        <table>

                        <tr><td>Name:</td><td><input name="Name" type="text" value="MyName1" /></td></tr>
                        <tr><td>Password:</td><td><input name="Password" type="password" /></td></tr>
                        <tr><td>Multiple:</td><td><select name="Multiple" multiple="multiple">

                            <optgroup label="Group 1">
                                <option value="one" selected="selected">One</option>
                                <option value="two">Two</option>

                                <option value="three">Three</option>
                            </optgroup>
                            <optgroup label="Group 2">
                                <option value="four">Four</option>

                                <option value="five">Five</option>
                                <option value="six">Six</option>

                            </optgroup>
                        </select></td></tr>
                        <tr><td>Single:</td><td><select name="Single">
                            <option value="one" selected="selected">One</option>
                            <option value="two">Two</option>

                            <option value="three">Three</option>

                        </select></td></tr>
                        <tr><td>Single2:</td><td><select name="Single2">
                            <optgroup label="Group 1">
                                <option value="A" selected="selected">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </optgroup>

                            <optgroup label="Group 2">
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                            </optgroup>
                        </select></td></tr>

                        <tr><td>Check:</td><td>

                            <input type="checkbox" name="Check" value="1" />
                            <input type="checkbox" name="Check" value="2" />
                            <input type="checkbox" name="Check" value="3" />
                        </td></tr>
                        <tr><td>Radio:</td><td>
                            <input type="radio" name="Radio" value="1" />
                            <input type="radio" name="Radio" value="2" />

                            <input type="radio" name="Radio" value="3" />

                        </td></tr>
                        <tr><td>Text:</td><td><textarea name="Text" rows="2" cols="20">This is Form1</textarea></td></tr>
                        </table>
                        <input type="reset"   name="resetButton " value="Reset" />
                        <input type="submit"  name="submitButton" value="Submit1" />
                        <input type="image"   name="submitButton" value="Submit2" src="submit.gif" />
                        <input type="image"   name="submitButton" value="Submit3" src="submit.gif" />
                        <input type="image"   name="submitButton" value="Submit4" src="submit.gif" />

                </div></form>
                <h1>Output Div (#output1):</h1>
                <div id="output1">AJAX response will replace this content.</div>
-->


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
