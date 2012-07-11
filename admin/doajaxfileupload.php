<?php
	session_start();
  if( (!isset($_SESSION['is_login'])) && ($_SESSION['role'] != "admin") ){
	  Header("location:../error.php");
	exit();
  }
	include('../template/dbsetup.php');
	//../a/b.php-->回到上一層目錄，找上一層目錄中的a目錄中的b.php檔案
  $bid = $_SESSION['bid'];

	$error = "";
	$msg = "";
	$fileElementName = 'fileToUpload';
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
			$msg .= " File Name: " . $_FILES['fileToUpload']['name'] . ", ";
			$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);

			
			//
			//
			$fp      = fopen($_FILES['fileToUpload']['tmp_name'], 'r');
			$content = fread($fp, filesize($_FILES['fileToUpload']['tmp_name']));
			$content = addslashes($content);
			fclose($fp);
			

			//Developed by elviscat
			//Connect to database
			$link = mysql_connect($host , $dbuser ,$dbpasswd); 
			//$msg .= "<br>".$host."<br>".$dbuser."<br>".$dbpasswd."<br>".$dbname;
			
			if (!$link) {
   				die('Could not connect: ' . mysql_error());
			}

			//select database
			mysql_select_db($dbname);
            
			//$msg .= "UPDATE user SET photo='1' WHERE username='".$_SESSION['username']."'";
			//$msg .= $_SESSION['username'];
			//$msg .= $content;
			
			//mysql query
			
			if( isset($_SESSION['bid']) ){
			  $maxMid = 0;
        $sql = "SELECT MAX(mid) FROM adminspeciesmultimedia";
			  $result = mysql_query ($sql) or die ("Invalid query");
				if(mysql_num_rows($result)>0){
					while ( $nb = mysql_fetch_array($result)) {
						$maxMid = $nb[0]+1;
					}
				}else{
					$maxMid = 1;
				}
				$date = date("Y-m-d H:i:s");//"2008-08-28 11:03:21"
				
        /*
        $insertSql = "INSERT INTO adminspeciesmultimedia (mid, content, date, refid, reflid, descr) VALUES ";
        //$insertSql .= "(".$maxMid.", ".$content.", ".$date.", ".$bid.", \"Empty Reference Location Id, You can denote one!\", \"Default Description\")";
        */
        //$msg .= " ".$insertSql;
        
        //echo $insertSql;
        mysql_query("INSERT INTO adminspeciesmultimedia (mid, content, date, refid, reflid, descr) VALUES ('".$maxMid."', '".$content."', '".$date."', '".$bid."', 'Empty Reference Location Id, You can denote one!', 'Default Description')");
				//釋放session變數
				session_unregister($_SESSION['bid']);
			}
			//mysql_query("UPDATE user SET photo='".$content."' WHERE username='".$_SESSION['username']."'");

			//for security reason, we force to remove all uploaded file
			@unlink($_FILES['fileToUpload']);			
					
	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>