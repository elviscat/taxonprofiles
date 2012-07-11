<?php
  //Developed by elviscat (elviscat@gmail.com)
  //March 12, 2009 Thursday::add external link to record the location and multi-media documents
  // ./ current directory
  // ../ up level directory
  session_start();
  if( (!isset($_SESSION['is_login'])) && ($_SESSION['role'] != "admin") ){
	  Header("location:../error.php");
	exit();
  }
  include('../template/dbsetup.php');
  $bid = htmlspecialchars($_GET['bid'],ENT_QUOTES);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="../template/edit.css" type="text/css" />
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA53TeMwGJV1oqIQjLa45WyxTO77323e5EQasSc_FJjkcu6rRTGRQiV1KZDp2WvKjIDfygjeGmfPEyhg"
      type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function load() {
	if (GBrowserIsCompatible()) {
		var myMap = new GMap2(document.getElementById("my_map"));
		//var myLatLng = new GLatLng(25.04763902653048, 121.51715755462646);
		//(38.637039, -90.233208)
    var myLatLng = new GLatLng(38.637039, -90.233208);
		myMap.setCenter(myLatLng, 15);
		myMap.addControl(new GLargeMapControl());
		document.getElementById('inLatLng').value = myLatLng.toString();
		
		var myMarker = new GMarker( myLatLng );
		myMap.addOverlay( myMarker );
		
		GEvent.addListener(myMap, "click", function( overlay, point ){
								if(point){
									//set up the remark location
									myMarker.setLatLng(point);
									document.getElementById('inLatLng').value = point.toString();
								}
							});

	}
}
//]]>
</script>
<script src="../jquery/jquery.js" type="text/javascript" language="javascript"></script>
<script src="../jquery/jquery.form.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript">
  // wait for the DOM to be loaded 
  $(document).ready(function() { 
    // bind 'speciesEditor' and provide a simple callback function 
    $(#geocodingEditor').ajaxSubmit(function() {  
      return false; 
    });        
  });
</script>
<title>Add your location data</title>
</head>
<body onload="load()" onunload="GUnload()">
  <div id="basic" class="myform">
    <form id="geocodingEditor" action="geocoding2.php" method="post">  
      <h1>Geocoding Form</h1>
      <p>Add the species distribution and information with Google Maps Support</p>


        
	    <label>Description
        <span class="small">Add some description for this speices on this location</span>
      </label>
        <textarea name="desc" rows="20" cols="15"></textarea>

      <label>Latitude and Longitude
        <span class="small">Add it</span>
      </label>
        <input id="bid" name="bid" type="hidden" value="<? echo $bid; ?>" />
        <input id="inLatLng" name="inLatLng" type="text" size="50" value="" />
      <button  type="submit">Add Location information</button>
      <div class="spacer"></div>
    </form>
    <!--
    <form id="form" name="form" method="post" action="index.html">
      <h1>Sign-up form</h1>
      <p>This is the basic look of my form without table</p>

      <label>Name
        <span class="small">Add your name</span>
      </label>
      <input type="text" name="name" id="name" />

      <label>Email
        <span class="small">Add a valid address</span>
      </label>
      <input type="text" name="email" id="email" />

      <label>Password
        <span class="small">Min. size 6 chars</span>
      </label>
      <input type="text" name="password" id="password" />

      <button type="submit">Sign-up</button>
      <div class="spacer"></div>
    </form>
    -->
    <div align="center"><a href="speciesEditor2.php?sid=<? echo $bid; ?>">Back to Editor</a>
    <br><br><br>
    <div id="my_map" style="width: 360px; height: 360px"></div></div>
  </div>
</body>
</html>