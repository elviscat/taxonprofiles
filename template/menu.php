<?php
	//Developed by elviscat (elviscat@gmail.com)
	//March 14, 2009 Saturday:: dynamic navigation based on different levels of users
	//May 10, 2012 Thursday:: modification
	
	// ./ current directory
	// ../ up level directory
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
	
?>
	<div  id="menu">
		<ul>
			<!--<li id="current"><a href="<? echo $dirPath; ?>index.php">Home</a></li>-->
			<li><a href="<? echo $dirPath; ?>index.php">Home</a></li>
			<!--<li><a href="<? echo $dirPath; ?>blog">Taxonomic Blog</a></li>-->
			<li><a href="<? echo $dirPath; ?>treelist.php">Browse Classification</a></li>
			<li><a href="<? echo $dirPath; ?>profiles_docs.php">Profiles Docs</a></li>
			<li><a href="<? echo $dirPath; ?>searchspecies.php">Search Species</a></li>
			<li><a href="<? echo $dirPath; ?>docadmin.php?doc_type=author">Update to Taxa</a></li>
			<li><a href="<? echo $dirPath; ?>aboutus.php">About Us</a></li>		
		</ul>
	</div>