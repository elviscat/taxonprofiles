<?PHP
  //Developed by elviscat (elviscat@gmail.com)
  //March 13, 2009 Friday::new blog entry post
  // ./ current directory
  // ../ up level directory
  session_start();
  if( (!isset($_SESSION['is_login'])) ){
	  Header("location:../error.php");
	  exit();
  }  
  $prefuid = $_SESSION['uid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="edit.css" type="text/css" />
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
<title>Add a new post!</title>
</head>
<body>
  <div id="basic" class="myform">
    <h1>Add a new post!</h1>
    <p>Please leave you post here.</p>
    <form id="newPost" action="newPost2.php" method="post">
      <label>Title
        <span class="small">Add the title</span>
      </label>
        <input id="prefuid" name="prefuid" type="hidden" value="<? echo $prefuid; ?>" />
        <input id="title" name="ptitle" type="text" size="100" value="" /><p>
	  <label>Category
        <span class="small">Add some category</span>
      </label>
        <input id="category" name="pcategory" type="text" size="100" value="" /><p>
	  <label>Tag
        <span class="small">Add some tag with comma</span>
      </label>
        <input id="ptag" name="ptag" type="text" size="100" value="" /><p>
	  <label>Content
        <span class="small">Add your cotent</span>
      </label>
        <!--<span class="small">--><textarea name="pcontent" rows="30" cols="30"></textarea><!--</span><p>-->
      <button  type="submit">Post it!</button>
    </form>
    <br><br>
    <div align="center"><p><a href="index.php">Back to management page</a></p> </div>
    <!--<div align="center"><a href="../index.php">Return to index</a><br></div>-->

  </div>
</body>
</html>
