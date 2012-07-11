<?PHP
  //Developed by elviscat
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
  $_SESSION['bid'] = $bid;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="../template/edit.css" type="text/css" />
<script src="../jquery/jquery.js" type="text/javascript" language="javascript"></script>
<script src="../jquery/ajaxfileupload.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript">
<!--
  function ajaxFileUpload(){
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
      $.ajaxFileUpload({
        url:'doajaxfileupload.php',
        secureuri:false,
        fileElementId:'fileToUpload',
        dataType: 'json',
        success: function (data, status){
          if(typeof(data.error) != 'undefined'){
            if(data.error != ''){
              alert(data.error);
            }else{
              alert(data.msg);
            }
          }
        },
        error: function (data, status, e){
          alert(e);
        }
      })   
    return false;
  }
//-->
</script>
<title>Upload your document</title>
</head>
<body>
  <div id="basic" class="myform">
    <h3>Upload your profile</h3>
    <img id="loading" src="../images/loading.gif" style="display:none;">
    <form id="fileUpload" action="" method="post" enctype="multipart/form-data">
      Please select a file and click Upload button
      <input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input">
      <button class="button" id="buttonUpload" onClick="return ajaxFileUpload();">Upload</button>
      <br>
    </form>
    <a href="speciesEditor2.php?sid=<? echo $bid; ?>">Back to Editor</a>
  </div>
</body>
</html>