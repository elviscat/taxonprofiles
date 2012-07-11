<?php
        $link = mysql_connect("localhost", "root", "nb6m2mmt") or die("Could not connect: " . mysql_error());
        // select our database
        mysql_select_db("cypcom") or die(mysql_error()); 
        // get the image from the db
        $sql = "SELECT photo FROM user WHERE username='elviscat'";
        // the result of the query
        $result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
        // set the header for the image
        header("Content-type: image/jpeg");
        echo mysql_result($result, 0);
        // close the db link
        mysql_close($link);
?>