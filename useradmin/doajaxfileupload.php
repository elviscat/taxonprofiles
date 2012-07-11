<?php
	session_start();
	include('../template/dbsetup.php');
	//../a/b.php-->回到上一層目錄，找上一層目錄中的a目錄中的b.php檔案

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
			//$size = 52428800;
      $fp      = fopen($_FILES['fileToUpload']['tmp_name'], 'r');
			$content = fread($fp, filesize($_FILES['fileToUpload']['tmp_name']));
			//$content = fread($fp, $size);
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
			
			if($_SESSION['ccdoc_id'] && $_SESSION['ccmeta_id']){
				/*
				$sql = "SELECT * FROM cc_img WHERE ccdoc_id='".$_SESSION['ccdoc_id']."' AND ccmeta_id='".$_SESSION['ccmeta_id']."'";
				
				$result = mysql_query ($sql) or die ("Invalid query");
	    		if(mysql_num_rows($result) > 0 ){
					mysql_query("UPDATE cc_img SET pic_content='".$content."' WHERE ccdoc_id='".$_SESSION['ccdoc_id']."' AND ccmeta_id='".$_SESSION['ccmeta_id']."'");
				}else{
				*/
					$max_ccimg_id = 0;
					$sql2 = "SELECT MAX(ccimg_id) FROM cc_img";
					$result2 = mysql_query ($sql2) or die ("Invalid query");
					if(mysql_num_rows($result2)>0){
						while ($nb=mysql_fetch_array($result2)) {
							$max_ccimg_id = $nb[0]+1;
							//echo "max_ccdocid is ".$max_ccdocid;
						}
					}else{
						$max_ccimg_id = 1;
					}
					mysql_query("INSERT INTO cc_img (ccimg_id, ccdoc_id, ccmeta_id, pic_content, img_desc) VALUES ('".$max_ccimg_id."','".$_SESSION['ccdoc_id']."','".$_SESSION['ccmeta_id']."','".$content."','".$_SESSION['img_desc']."')");
					//釋放session變數
					session_unregister($_SESSION['ccdoc_id']);
					session_unregister($_SESSION['ccmeta_id']);
					session_unregister($_SESSION['img_desc']);
				/*
				}
				*/
				
			}else{
				mysql_query("UPDATE user SET photo='".$content."' WHERE username='".$_SESSION['username']."'");
			}
			unset( $content);
			//mysql_query("UPDATE user SET photo='".$content."' WHERE username='".$_SESSION['username']."'");

			//for security reason, we force to remove all uploaded file
			@unlink($_FILES['fileToUpload']);			
					
	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>