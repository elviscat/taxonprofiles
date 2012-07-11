<?PHP
/******************************
**	metadatatableediting.php
**	elviscat@gmail.com
**  Elvis Wu
**  06/02/2009 Tuesday
**  version2:
**  05/12/2012 Saturday
**  version3:
**  0?/??/200? Wednesday?
*******************************/
session_start();
include('../template/dbsetup.php');

//pre-check for the identification
if(!isset($_SESSION['is_login'])){
	Header("location:error.php");
	exit();
}
if( $_SESSION['role'] != 'admin'){
	Header("location:error.php");
	exit();
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Taxon Profiles Profile Document Meta Editing</title>

<!--Add the reference here-->
<script type="text/javascript" src="jquery-1.3.2.min.js"></script><!-- jQuery http://jquery.com -->
<script type="text/javascript" src="js/jqDnR.js"></script><!-- Required for auto generated forms in nav bar  -->
<script type="text/javascript" src="js/jqModal.js"></script><!-- Required for auto generated forms in nav bar  -->
<script type="text/javascript" src="jquery.jqGrid.js"></script><!-- jqGrid http://www.trirand.com/blog/ -->
<!--Here!!-->
<script type="text/javascript" src="metadatatableediting.js"></script><!-- specific js for this page. -->
<!--Here!!-->
<link rel="stylesheet" type="text/css" media="screen" href="themes/jqModal.css" /><!-- jqModal css -->
<link rel="stylesheet" type="text/css" media="screen" href="themes/basic/grid.css" /> <!-- jqgrid theme -->
<!--Add the reference here-->


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
	<div id="content-wrap">
		<div id="main">
        <div id="msg"></div>
            <p>Hi, <font color="blue"><? echo $_SESSION['username'];?></font></p>
            <p>
              <table id="htmlTable" class="scroll"></table>
	          <div id="htmlPager" class="scroll"></div>
			  <!--<a href="self.close ()">Close this Window</a>-->
			</p>
		</div>
		</div>
	</div>
</div>
</body>
</html>
