<?
session_start();
include('template/dbsetup.php');
include('inc/config.inc.php');
?>
<?
if(!isset($_SESSION['is_login'])){
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
<title>CypCom User Admin</title>
<script src="jquery/jquery.js" type="text/javascript" language="javascript"></script>
<script src="useradmin/jquery.jeditable.js" type="text/javascript" language="javascript"></script>
<script src="useradmin/multiple-file-upload/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>
<script src="useradmin/ajaxfileupload.js" type="text/javascript" language="javascript"></script>
<script src="useradmin/useradmin.js" type="text/javascript" language="javascript"></script>
<link rel=stylesheet type="text/css" href="useradmin/useradmin.css">
<script type="text/javascript">
<!--

$(document).ready(function(){
	$(".edit").editable("useradmin/response_save.php", {
		type	  : 'textarea',
		cancel    : 'Cancel',
		submit    : 'OK',
		indicator : '<img src="useradmin/images/loading.gif">',
		tooltip   : 'Click to edit...'
		});
	//$('#test1').submit(ajaxFileUpload);	
});


function ajaxFileUpload()
    {
        //starting setting some animation when the ajax starts and completes
        $("#loading")
        .ajaxStart(function(){
            $(this).show();
        })
        .ajaxComplete(function(){
            $(this).hide();
        });
       
        /*
            prepareing ajax file upload
            url: the url of script file handling the uploaded files
                        fileElementId: the file type of input element id and it will be the index of  $_FILES Array()
            dataType: it support json, xml
            secureuri:use secure protocol
            success: call back function when the ajax complete
            error: callback function when the ajax failed
           
                */
        $.ajaxFileUpload
        (
            {
                url:'useradmin/doajaxfileupload.php',
                secureuri:false,
                fileElementId:'fileToUpload',
                dataType: 'json',
                success: function (data, status)
                {
                    if(typeof(data.error) != 'undefined')
                    {
                        if(data.error != '')
                        {
                            alert(data.error);
                        }else
                        {
                            alert(data.msg);
                        }
                    }
                },
                error: function (data, status, e)
                {
                    alert(e);
                }
            }
        )
       
        return false;

    }




//-->
</script>
</head><body>
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
      <h4>Hi, <font color="blue"><? echo $_SESSION['username'];?></font>. Welcome to your admin manage page.</h4>
      <h3>Species Editing</h3>
      <form method="post" action="" id="edit_profile_form">
        <p>
		<a href="speciesEditor.php">Edit the species data(OK)</a>
        </p>
        <p>
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