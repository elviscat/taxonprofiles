<?php
/******************************
**	TaxonProfilesList.php
**  WebAPIs:: Show Taxon Profiles List
**	elviscat@gmail.com
**  Elvis Hsin-Hui Wu
**  version1: 07/01/2012 Sunday::New Build
**  version?: ??/??/20?? Monday?::
**  version?: ??/??/20?? Friday?::
**
*
*******************************/
include('../template/dbsetup.php');
include('../inc/config.inc.php');

//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
   	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");



class TaxonProfilesList extends Control implements RESTfulInterface {
    function restPost($segments) {
        echo 'Create resource';
        echo '<br/><pre>';
        print_r($_POST);
        echo '</pre>';
    }
 
    function restGet($segments) {
        $id = $segments[0];
        if ($id == 'showlist'){

			//$taxonprofileslist = 'Hello Elvis<BR>\n';
			$taxonprofileslist;
			$sql = "SELECT * FROM biglonglist ORDER BY mfamily ASC";
			$result = mysql_query ($sql) or die ("Invalid query of sql_family");
			if(mysql_num_rows($result)>0){
				//$taxonprofileslist .= "<table width=\"300\">";
				//$taxonprofileslist .= "<tr>";
				//$taxonprofileslist .= "<th align=\"left\">Family</td>";
				//$taxonprofileslist .= "<th align=\"left\">Genus</td>";
				//$taxonprofileslist .= "<th align=\"left\">Species</td>";
				//$taxonprofileslist .= "<th align=\"left\">Author</td>";
				//$taxonprofileslist .= "<th align=\"left\">Type Locality</td>";
				//$taxonprofileslist .= "</tr>";
				//$taxonprofileslist .= "Family\tSpecies\tAuthor<BR>\n";
				$taxonprofileslist .= "Species\tAuthor<BR>\n";

				while ($nb = mysql_fetch_array($result)) {
					//mfamily 	mgenus 	mspecies 	mauthor 	mtypelocal 	mccode 	mpaese
					//$taxonprofileslist .= "<tr bgcolor=\"#FDDC99\">";
					//$taxonprofileslist .= "<tr>";
					//$taxonprofileslist .= "<td align=\"left\">".$nb['mfamily']."</td>\n";
					//$taxonprofileslist .= "<td align=\"left\">".$nb['mgenus']."</td>\n";
					//$taxonprofileslist .= "<td align=\"left\"><a href=\"http://maydenlab.slu.edu/~hwu5/taxonprofiles/viewtaxon.php?id=".$nb['bid']."\"><i>".$nb['mgenus']." ".$nb['mspecies']."</i></a></td>\n";
					//$taxonprofileslist .= "<td align=\"left\">".$nb['mauthor']."</td>\n";
					//$taxonprofileslist .= "<td align=\"left\">".$nb['mtypelocal']."</td>\n";
					//$taxonprofileslist .= "</tr>";
					//$taxonprofileslist .= $nb['mfamily']."\t<a href=\"http://maydenlab.slu.edu/~hwu5/taxonprofiles/viewtaxon.php?id=".$nb['bid']."\"><i>".$nb['mgenus']." ".$nb['mspecies']."</i></a>\t".$nb['mauthor']."<BR>\n";
					$taxonprofileslist .= "<a href=\"http://maydenlab.slu.edu/~hwu5/taxonprofiles/viewtaxon.php?id=".$nb['bid']."\"><i>".$nb['mgenus']." ".$nb['mspecies']."</i></a>\t".$nb['mauthor']."<BR>\n";
				}
			}

			echo $taxonprofileslist;
            //echo 'Read resource: elvis' . $segments[0]."<BR>\n"; // id
            //echo 'Read and show list';
        }
        else{
            self::exceptionResponse(404, 'Not found');
        }
    }
 
    function restPut($segments) {
        echo 'Update resource: ' . $segments[0];
        echo '<br/> you put data: ' . file_get_contents('php://input'); // read the raw put data.
    }
 
    function restDelete($segments) {
        echo 'Delete resource: ' . $segments[0];
    }
}
?>