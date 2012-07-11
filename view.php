<?
include('template/dbsetup.php');
$link = mysql_connect($host , $dbuser ,$dbpasswd) or die("Could not connect: " . mysql_error());
// select our database


function aaa($filename){
        
        $percent = 0.5;
$width = 200;
$height = 200;
        header("Content-type: image/jpeg");
        
        
        
		
		
list($width, $height) = getimagesize($filename);
$new_width = $width * $percent;
$new_height = $height * $percent;

// Resample
$image_p = imagecreatetruecolor($new_width, $new_height);
$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Output
imagejpeg($image_p, null, 100);
}



mysql_select_db($dbname) or die(mysql_error()); 
    if(isset($_GET['username'])) {
        // get the image from the db
        $sql = "SELECT photo FROM user WHERE username='".$_GET['username']."'";
        // the result of the query
        $result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
        // set the header for the image
        header("Content-type: image/jpeg");
        echo mysql_result($result, 0);
    }else if($_GET['docid'] && $_GET['ccmetaid']){
        // get the image from the db
        $sql = "SELECT pic_content FROM cc_img WHERE ccdoc_id='".$_GET['docid']."' AND ccmeta_id='".$_GET['ccmetaid']."'";
        // the result of the query
        $result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
        // set the header for the image
        header("Content-type: image/jpeg");
		echo mysql_result($result, 0);
		
		
		
        
    }else if( $_GET['mode'] == "adminMediaManagement" ){
        //echo "Hello";
        // get the image from the db
        $sql = "SELECT content FROM adminspeciesmultimedia WHERE refid='".$_GET['refid']."' AND mid='".$_GET['mid']."'";
        // the result of the query
        $result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
        // set the header for the image
        header("Content-type: image/jpeg");
        echo mysql_result($result, 0);
    }else if( $_GET['mode'] == "index" && $_GET['ccimgid'] ){
        //echo "Hello";
        // get the image from the db
        $sql = "SELECT pic_content FROM cc_img WHERE ccimg_id='".$_GET['ccimgid']."'";
        // the result of the query
        $result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
        
        
        // set the header for the image
        header("Content-type: image/jpeg");
        echo mysql_result($result, 0);
        //aaa(mysql_result($result, 0));
        


		
    }else if( $_GET['ccimg_id'] != "" ){
        $sql = "SELECT pic_content FROM cc_img WHERE ccimg_id='".$_GET['ccimg_id']."'";
        // the result of the query
        $result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
        // set the header for the image
        header("Content-type: image/jpeg");
        echo mysql_result($result, 0);
    }else {
        echo 'File not selected';
    }
// close the db link
mysql_close($link);
?>