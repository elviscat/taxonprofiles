<?php
	//Developed by elviscat (elviscat@gmail.com)
	//March 14, 2009 Saturday:: dynamic navigation based on different levels of users 
	// ./ current directory
	// ../ up level directory
	
	$loginOrout = "<a href=\"".$dirPath."login.php\">Log In</a>";
	
	$dirPath = "";
	
	/*
	$tmp_array = explode("/", $_SERVER['PHP_SELF']);
	$tmp1 = sizeof($tmp_array);
	//$tmp2 = (sizeof($tmp_array)-1);
	$tmp3 = $tmp1 - 4;
	//echo "\$tmp3 is :: ".$tmp3."<BR />\n";
	for( $i = 0; $i < $tmp3; $i++){
		$dirPath .= "../";
	}
	*/

	if(isset($_SESSION['is_login'])){
		$loginOrout = "<a href=\"".$dirPath."logout_to.php\">Log Out</a>";
	}
	
?>
    <div id="header">			
		<!--<h1 id="logo-text"><a href="index.php">Cypriniformes Commons</a></h1>-->
		<h1 id="logo-text"><a href="<? echo $dirPath; ?>index.php">Taxon Profiles</a></h1>
		<p id="slogan">of Cypriniformes Commons | BETA</p>
		
		<!--
		<link rel="stylesheet" href="template/themes/base/jquery.ui.all.css">
		<script src="template/jquery-1.7.2.js"></script>
		<script src="template/ui/jquery.ui.core.js"></script>
		<script src="template/ui/jquery.ui.widget.js"></script>
		<script src="template/ui/jquery.ui.mouse.js"></script>
		<script src="template/ui/jquery.ui.draggable.js"></script>
		<link rel="stylesheet" href="template/demos.css">
		
		<style>
			#send_feedback { width: 300px; height: 20px; padding: 1.5em; }
		</style>
		<script>
			$(function() {
				$( "#send_feedback" ).draggable();
			});
		</script>
		
		
		<div id="send_feedback" class="ui-widget-content">
			<p>Send a Review Feedback</p>
		</div>
		-->
		<?php
			$request_uri_array = explode("/", $_SERVER["REQUEST_URI"]);
			$filename = $request_uri_array[sizeof($request_uri_array)-1];
		?>
		<div id="header-links">
			<p>
				<a href="<? echo $dirPath; ?>index.php">Home</a> | 
				<a href="<? echo $dirPath; ?>recommendation.php">Recommendations</a> | 
				<a href="<? echo $dirPath; ?>report_testing.php?page_name=<?php echo $filename; ?>">Report Testing Suggestions</a> | 
				<!--  Report Bugs, Comments and Suggestions to Developer -->
				<!--<a href="login.html">Login</a>//Original Setting-->
				<?php echo $loginOrout; ?>
			</p>
		</div>
	</div>



