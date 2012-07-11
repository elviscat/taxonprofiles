<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>CypCom Admin Editor 2</title>
<script type="text/javascript" src="../jquery/jquery.js"></script> 
<script type="text/javascript" src="../jquery/jquery.form.js"></script> 
<script type="text/javascript"> 
<!--
  // wait for the DOM to be loaded 
  $(document).ready(function() { 
    // bind 'myForm' and provide a simple callback function 
    //$('#myForm').ajaxForm(function() {
    $('#myForm').ajaxSubmit(function() { 
      //alert("Thank you for your comment!");
      return false;
    }); 
  }); 
-->
</script>
</head>
<body>
<?
echo md5('xu3r85')."<br>";
?>
<form id="myForm" action="test2.php" method="post" width=500> 
    Name: <input type="text" name="name" /><br><br> 
    Comment: <textarea name="comment"></textarea> 
    <input type="submit" value="Submit Comment" /> 
</form>
</body>
</html>